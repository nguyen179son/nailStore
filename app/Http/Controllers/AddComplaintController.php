<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddComplaintController extends Controller
{
    public function addComplaint(Request $request) {
//        $input = $request->all();
//        $validation = Validator::make($input, [
//            'content' => 'required|string|max:255',
//        ]);
//
//        if ($validation->fails()) {
//            return $validation->messages();
//        }
        $name = $request["name"];
        $email = $request["email"];
        $content = $request["content"];
        if (!$content) {
            return response()->json([
                "success" => false,
                "message" => "You need to input content"
            ], 200);
        }
        if (strlen($content) >= 255) {
            return response()->json([
                "success" => false,
                "message" => "Content may not be greater than 255 characters"
            ], 200);
        }
        DB::table("complaints")->insert([
            'content' => $content,
            'email' => $email,
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([
            "success" => true,
            "message" => "Your complaint has been sent"
        ], 200);
    }
}
