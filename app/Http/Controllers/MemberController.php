<?php

namespace App\Http\Controllers;

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
            'name' => 'required|string'
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
        $email = $request->email;
        $name = $request->name;
//        dd($email, $name);
        $check = DB::table("customers")->where("email", "=",$email)->first();
        if ($check != null) {
            return response()->json([
                "success" => false,
                "message" => "Customer already existed !"
            ]);
        }
        DB::table("customers")->insert([
            'email' => $email,
            'name' => $name,
            'point' => 0,
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
        $members = $members->where('name','like', '%' . $keyword . '%');
        $members = $members->orderBy("point", "desc")->paginate(3);
        return view("pagination_customers", compact("members"))->render();
    }

    public function addPoint(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }
        Member::where('email', $input['email'])->increment('point');
        return response()->json(['success' => 'Successfully added point']);
    }

    function comparator($object1, $object2) {
        return $object1->updated_at > $object2->updated_at;
    }
    public function history($id) {
        $email = Member::find($id)->email;
        $dropIn=DB::table('drop_in_reservations')->where('email','=',$email)->select(['updated_at','status','type as service_type'])->get()->toArray();
        $online = DB::table('online_reservations')->where('email','=',$email)->select(['updated_at','status','service_type'])->get()->toArray();
//        dd($dropIn, $online);
        $return_array = array_merge($dropIn,$online);
//        dd($return_array);
        usort($return_array, array($this,'comparator'));
//        foreach ($return_array as $key => $value) {
//            $return_array[$key] = Collection::make($value);
//        }
//        $return_array->paginate(10);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($return_array);
        $perPage = 3;
        $currentPageSearchResult = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResult, count($col), $perPage);

//        $return_array = Collection::make($return_array);

        return view("pagination_member_history", compact("entries"))->render();
    }

}
