<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientManagerController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view("client_management");
    }
}
