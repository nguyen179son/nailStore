<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $complaints = DB::table("complaints")->paginate(5);
        return view('complaint', ['complaints' => $complaints]);
    }
}
