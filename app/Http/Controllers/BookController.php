<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class BookController extends Controller
{
    public function index() {
        return view('booking');
    }
    public function store(Request $request) {
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required|string',
            'telephone' => 'required|phone_number'
        ]);
    }
}
