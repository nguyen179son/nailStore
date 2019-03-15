<?php

namespace App\Http\Controllers;

use App\OnlineReservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
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
            'name' => 'required|string|max:100',
            'telephone' => 'required|phone_number|max:20',
            'email' => 'required|email|max:100',
            'type' => 'required|string',
        ]);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $input['status'] = 'waiting';
        $dropInBooking = new DropInReservations($input);
        $dropInBooking->save();
        return redirect('/dropin-queue');
    }

    public function show()
    {
        $data = DB::table('drop_in_reservations')->whereNull('deleted_at')->whereIn('status',['waiting','doing'])
            ->orderBy('created_at', 'asc')->paginate(10);

        return view('dropinQueue', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('drop_in_reservations')->whereNull('deleted_at')->whereIn('status',['waiting','doing'])
                ->orderBy('created_at', 'asc')->paginate(10);
            return view('pagination_data', compact('data'))->render();
        }
    }

    public function destroy($id)
    {
        $res = DropInReservations::find($id);
        $res->delete();
        return response()->json(['success' => 'Record is successfully deleted']);
    }

    public function count()
    {
        return DropInReservations::all()->whereIn('status',['waiting','doing'])->count();
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'id' => 'required|integer',
            'status' => 'required|string',
        ]);
        if ($validation->fails()) {
            return $validation->messages();
        }
        DB::table('drop_in_reservations')->where('id', '=', $input['id'])->update(array('status'=> $input['status']));
        return Response::make("", 204);
    }
}
