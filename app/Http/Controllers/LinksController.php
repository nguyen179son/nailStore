<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('settings');
    }

    public function changeLink(Request $request) {
        $type = $request->type;
        $url = $request->url;
//        dd($request);
        DB::table("links")->where("type", $type)->update(['url' => $url]);
        return response()->json([
            "success" => true,
            "type" => $type,
            "url" => $url
        ]);
    }

    public function deleteLink(Request $request) {
        $type = $request->type;
        DB::table("links")->where("type", $type)->update(['url' => '']);
        return response()->json([
            "success" => true,
            "type" => $type
        ]);
    }

    public function getBannerLinks(Request $request) {
        $links = DB::table('links')->whereNotNull('url')->where('type', 'like','b%')->get('url');
        return response()->json($links);
    }

    public function getPopupLinks(Request $request) {
        $links = DB::table('links')->whereNotNull('url')->where('type', 'like','p%')->get('url');
        return response()->json($links);
    }

    public function getLinks(Request $request) {
        $links = DB::table('links')->where('type', '!=','e')->get(['type', 'url']);
        return response()->json($links);
    }

    public function getEmployees(Request $request) {
        $links = DB::table('links')->whereNotNull('url')->where('type', '=','e')->first();
        return response()->json($links->url);
    }
}
