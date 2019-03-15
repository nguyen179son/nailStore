<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }
        $input['point'] = 0;
        $member = new Member($input);
        $member->save();

        return response()->json(['success' => 'Record is successfully added']);
    }

    public function show()
    {
        $members = Member::all();
        return $members;
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
            $input['point'] = 1;
            $member = new Member($input);
            $member->save();
            return response()->json(['success' => 'Successfully added point']);
        }
    }

    public function minusPoint(Request $request)
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
            Member::where('email', $input['email'])->decrement('point', 1);
            return response()->json(['success' => 'Successfully decreased point']);
        } else {
            $input['point'] = 0;
            $member = new Member($input);
            $member->save();
            return response()->json(['success' => 'Successfully decreased point']);
        }
    }

    function comparator($object1, $object2)
    {
        return $object1->updated_at > $object2->updated_at;
    }

    public function history($id)
    {
        $email = Member::find($id)->email;
        $dropIn = DB::table('drop_in_reservations')->where('email', '=', $email)->select(['updated_at', 'status', 'type'])->get()->toArray();
        $online = DB::table('online_reservations')->where('email', '=', $email)->select(['updated_at', 'status', 'service_type'])->get()->toArray();
        $return_array = array_merge($dropIn, $online);
        usort($return_array, array($this, 'comparator'));
        return response()->json($return_array, 200);
    }

}
