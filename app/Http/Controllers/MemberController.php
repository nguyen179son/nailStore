<?php

namespace App\Http\Controllers;

use App\DropInReservations;
use App\Member;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Validator;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addMember(Request $request)
    {
        $input = $request->all();
        if (isset($input['email']) && $input['email'] != null) {
            $validation = Validator::make($input, [
                'email' => 'email',
                'phone_number' => 'required|phone_number|max:20|unique:customers',
                'name' => 'required|string',
                'customer_code' => 'required|unique:customers'
            ]);
        } else {
            $validation = Validator::make($input, [
                'phone_number' => 'required|phone_number|max:20|unique:customers',
                'name' => 'required|string',
                'customer_code' => 'required|unique:customers'
            ]);
        }
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->messages()]);
        }
        $phone_number = $request->phone_number;
        $email = $request->email;
        $name = $request->name;
        $customer_code = $request->customer_code;
//        $check = DB::table("customers")->where("phone_number", "=", $phone_number)->first();
//        if ($check != null) {
//            return response()->json([
//                "errors" => ['phone_number' => ["Duplicated phone_number"]]
//            ]);
//        }
        DB::table("customers")->insert([
            'email' => $email,
            'phone_number' => $phone_number,
            'name' => $name,
            'point' => 0,
            'customer_code' => $customer_code,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([
            "success" => true,
            "message" => "Customer successfully added !"
        ]);
    }

    public function show(Request $request)
    {
        $members = DB::table("customers");
        $keyword = $request->keyword;
        $members = $members->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('customer_code', '=',  $keyword);
        $members = $members->whereNull('deleted_at')
            ->orderBy(DB::raw('point mod 5'), 'desc')->paginate(10);
        return view("pagination_customers", compact("members"))->render();
    }

    public function addPoint(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'phone_number' => 'required|phone_number',
            'name' => 'required|string',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }

        $member = Member::where('phone_number', $input['phone_number'])->get();
        if (!$member->isEmpty()) {
            Member::where('phone_number', $input['phone_number'])->increment('point', 1);
            return response()->json(['success' => 'Successfully added point']);
        } else {
            return response()->json(['errors' => 'Error']);
        }
    }

    public function minusPoint(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'phone_number' => 'required|phone_number',
            'name' => 'required|string',
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }
        $member = Member::where('phone_number', $input['phone_number'])->get();
        if (!$member->isEmpty()) {
            DropInReservations::find($input['id'])->update(array('staff' => '', 'note' => '', 'receipt' => ''));
            Member::where('phone_number', $input['phone_number'])->decrement('point', 1);
            return response()->json(['success' => 'Successfully decreased point']);
        } else {
            return response()->json(['errors' => '']);
        }
    }

    function comparator($object1, $object2)
    {
        return $object1->updated_at > $object2->updated_at;
    }

    private function removePrefix($phone)
    {
        if ($phone[0] == '0') {
            return substr($phone, 1);
        } else if ($phone[0] = '+') {
            return substr($phone, 3);
        }
    }

    public function history($id)
    {
        $phone = Member::find($id)->phone_number;
        $phone = $this->removePrefix($phone);
        $dropIn = DB::table('drop_in_reservations')->where('telephone', '=', '0' . $phone)
            ->orWhere('telephone', '=', '+46' . $phone)
            ->select(['updated_at', 'status', 'type as service_type', 'staff', 'note', 'receipt'])->get()->toArray();
        $online = DB::table('online_reservations')
            ->where('mobile', 'like', '%' . $phone)
            ->orWhere('telephone','=','+46'.$phone)
            ->select(['updated_at', 'status', 'service_type', 'staff', 'note', 'receipt'])->get()->toArray();

        $return_array = array_merge($dropIn, $online);
        usort($return_array, array($this, 'comparator'));

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($return_array);
        $perPage = 10;
        $currentPageSearchResult = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResult, count($col), $perPage);

//        $return_array = Collection::make($return_array);
        return view("pagination_member_history", compact("entries"))->render();
    }

    public function destroy($id)
    {
        $member = Member::where('customer_code', $id);
        $member->forceDelete();
        return response()->json(['success' => true]);
    }

    public function updateDatabases()
    {
        $members = Member::all();
        foreach ($members as $member) {
            DropInReservations::where('email', $member->email)
                ->whereNull('telephone')
                ->where('name',$member->name)
                ->update(['telephone' => $member->phone_number]);
        }
    }
}
