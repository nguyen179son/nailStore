<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\DropInReservations;
class BookController extends Controller
{
    public function index() {
        return view('dropinbooking');
    }
    public function store(Request $request) {
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required|string',
            'telephone' => 'required|phone_number|digits_between:8,12',
            'email' => 'email',
            'type' => 'required|string',
        ]);
        if($validation->fails()) {
            return $validation->messages();
        }
        $dropInBooking = new DropInReservations($input);
        $dropInBooking->save();
        return view('queue');
    }
}
