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
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }
        Member::where('email', $input['email'])->increment('point');
        return response()->json(['success' => 'Successfully added point']);
    }
}
