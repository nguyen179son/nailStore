<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicLinksController extends Controller
{
    public function getBannerLinks(Request $request) {
        $links = DB::table('links')->whereNotNull('url')->where('type', 'like','b%')->get('url');
        return response()->json($links);
    }

    public function getPopupLinks(Request $request) {
        $links = DB::table('links')->whereNotNull('url')->where('type', 'like','p%')->get('url');
        return response()->json($links);
    }
}
