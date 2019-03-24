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
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'name' => 'required|string',
            'customer_code' => 'required|'
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }
        $input['point'] = 0;
        $member = new Member($input);
        $member->save();

        return response()->json(['success' => 'Record is successfully added']);
    }

    public function addMember(Request $request) {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email|unique:customers|max: 100',
            'name' => 'required|string|max: 100',
            'customer_code' => 'required|unique:customers'
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->messages()]);
        }
        $email = $request->email;
        $name = $request->name;
        $customer_code = $request->customer_code;
        $check = DB::table("customers")->where("email", "=",$email)->first();
        if ($check != null) {
            return response()->json([
                "errors" => ['email'=>["Duplicated email"]]
            ]);
        }
        DB::table("customers")->insert([
            'email' => $email,
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
        $members = $members->where('name','like', '%' . $keyword . '%')->orWhere('customer_code', 'like', '%' . $keyword . '%');
        $members = $members->orderBy(DB::raw('point mod 5'), 'desc')->paginate(10);
        return view("pagination_customers", compact("members"))->render();
    }

    public function addPoint(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'name' => 'required|string',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }

        $member = Member::where('email', $input['email'])->get();
        if (!$member->isEmpty()) {
            Member::where('email', $input['email'])->increment('point', 1);
            return response()->json(['success' => 'Successfully added point']);
        } else {
            return response()->json(['errors' => 'Error']);
        }
    }

    public function minusPoint(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'name' => 'required|string',
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }
        $member = Member::where('email', $input['email'])->get();
        if (!$member->isEmpty()) {
            DropInReservations::find($input['id'])->update(array('staff'=>'','note'=>'','receipt'=>''));
            Member::where('email', $input['email'])->decrement('point', 1);
            return response()->json(['success' => 'Successfully decreased point']);
        } else {
            return response()->json(['errors' => '']);
        }
    }

    function comparator($object1, $object2)
    {
        return $object1->updated_at > $object2->updated_at;
    }

    public function history($id)
    {
        $email = Member::find($id)->email;
        $dropIn=DB::table('drop_in_reservations')->where('email','=',$email)->select(['updated_at','status','type as service_type','staff','note','receipt'])->get()->toArray();
        $online = DB::table('online_reservations')->where('email','=',$email)->select(['updated_at','status','service_type','staff','note','receipt'])->get()->toArray();
        $return_array = array_merge($dropIn,$online);
        usort($return_array, array($this,'comparator'));

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($return_array);
        $perPage = 10;
        $currentPageSearchResult = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResult, count($col), $perPage);

//        $return_array = Collection::make($return_array);
        return view("pagination_member_history", compact("entries"))->render();
    }

}
