<?php

namespace App\Http\Controllers;

use App\OnlineReservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Helper\Table;
use Validator;
use App\DropInReservations;

class BookController extends Controller
{
    public function index()
    {
        return view('dropinbooking');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required|string',
            'telephone' => 'required|phone_number',
            'email' => 'required|email',
            'type' => 'required|string',
        ]);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $input['status'] = 'WAITING';
        $dropInBooking = new DropInReservations($input);
        $dropInBooking->save();
        return redirect('/dropinQueue');
    }

    public function show()
    {
        $data = \DB::table('drop_in_reservations')->whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(10);

        return view('dropinQueue', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $data = \DB::table('drop_in_reservations')->whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(10);
            return view('pagination_data', compact('data'))->render();
        }
    }

    public function destroy($id)
    {
        $res = OnlineReservations::find($id);
        $res->delete();
        return response()->json(['success' => 'Record is successfully deleted']);
    }

    public function count()
    {
        return DropInReservations::all()->count();
    }
}
