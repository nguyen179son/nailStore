<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        return view("admin");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route("getAdminLogin");
    }
}
