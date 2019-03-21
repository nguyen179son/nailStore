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
use App\Member;

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
        $today = date('Y-m-d');
        $data = DB::table('drop_in_reservations')
            ->whereNull('deleted_at')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['waiting'])
            ->orderBy('created_at', 'asc')->paginate(10);

        return view('dropinQueue', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $today = date('Y-m-d');
            $data = DB::table('drop_in_reservations')
                ->whereNull('deleted_at')
                ->whereDate('created_at', $today)
                ->whereIn('status', ['waiting'])
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
        return DB::table('drop_in_reservations')
            ->whereNull('deleted_at')
            ->whereIn('status', ['waiting'])
            ->count();
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
        DB::table('drop_in_reservations')->where('id', '=', $input['id'])->update(array('status' => $input['status']));
        return Response::make("", 204);
    }


    public function checkCustomerCode(Request $request)
    {
        $input = $request->query();
        $validation = Validator::make($input, [
            'code' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->messages()]);
        }
        $member = Member::where('email', $input['email'])->get();
        if (!$member->isEmpty()) {
            if ($member[0]->customer_code != $input['code']) {
                return response()->json(['errors' => array('code' => ['Incorrect code'])]);
            }
            return response()->json(['success' => '']);
        } else {
            return response()->json(['errors' => array('code' => ['Member not found, please contact staff for member registration'])]);
        }
    }

    public function checkout($id, Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'receipt' => 'required|numeric|max:100000',
            'note' => 'max:100',
            'staff' => 'required|max:100',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->messages()]);
        }

        $reservation = DropInReservations::find($id);
        if ($reservation) {
            foreach ($input as $key => $value) {
                $reservation->$key = $value;
            }
        }
        $reservation->save();
        return response()->json(['success' => '']);
    }

    public function addHistory(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'type' => 'required|string',
            'status' => 'required|string',
            'staff' => 'required|string|max:100',
            'note' => 'max:100',
            'receipt' => 'required|integer|max:100000',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->messages()]);
        }
        $id = $input['id'];
        unset($input['id']);
        $dropInBooking = new DropInReservations($input);
        $dropInBooking->save();
        Member::find($id)->increment('point', 1);

        return response()->json(['success' => '']);
    }

    public function income(Request $request)
    {
        $today = date('Y-m-d');
        $input = $request->all();
        if (isset($input['date']) && $input['date'] != null) {
            $today = date('Y-m-d', strtotime($input['date']));
        }
        $sum1 = DB::table('drop_in_reservations')
            ->whereNull('deleted_at')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['done'])
            ->whereNotNull('receipt')
            ->sum('receipt');
        $sum2 = DB::table('online_reservations')
            ->whereNull('deleted_at')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['done'])
            ->whereNotNull('receipt')
            ->sum('receipt');
        return $sum1 + $sum2;
    }
}
