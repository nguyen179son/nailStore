<?php

namespace App\Http\Controllers;

use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_online_data() {
        $now = date('Y-m-d H:i:s');
        $next_time = date('Y-m-d H:i:s',strtotime('-30 minutes',strtotime($now)));
        DB::table('online_reservations')->where([
            ['reservation_time', '<', $next_time],
            ['status', '=', 'waiting']
        ])->update(['status' => 'not come']);
    }

    public function update_dropin_data() {
        $now = date('Y-m-d');
        $next_time = date('Y-m-d H:i:s',strtotime('+0 day',strtotime($now)));
        DB::table('drop_in_reservations')->where([
            ['created_at', '<', $next_time],
            ['status', '=', 'waiting']
        ])->update(['status' => 'not come']);
    }

    function fetch_data_online(Request $request)
    {
        $this->update_online_data();
        if ($request->ajax()) {
            $input = $request->all();
            $data = DB::table('online_reservations')->whereNull('deleted_at')->where('type','=', 'book');
            if (isset($input['status']) && !empty($input['status'])) {
                foreach ($input['status'] as $key => $status) {
                    $input['status'][$key] = strtolower($status);
                }
                $data = $data->whereIn('status', $input['status']);
            }
            if (isset($input['service_type']) && !empty($input['service_type'])) {
                foreach ($input['service_type'] as $key => $service_type) {
                    $input['service_type'][$key] = strtolower($service_type);
                }
                $data = $data->whereIn('service_type', $input['service_type']);
            }
            if (isset($input['day']) && $input['day'] != null) {

                $validation = Validator::make($input, [
                    'day' => 'date|date_format:Y-m-d'
                ]);
                if ($validation->fails()) {
                    return $validation->messages();
                }
                $data = $data->whereDate('reservation_time', date('Y-m-d', strtotime($input['day'])));
            } else {
                $today = date('Y-m-d');
                $data = $data->whereDate('reservation_time', $today);
            }


            $data = $data->orderBy('reservation_time', 'asc');
            $data = $data->get()->toArray();

            foreach ($data as $value) {
                $code = DB::table('customers')
                    ->where('email', $value->email)->get();
                if ($code->isEmpty()) {
                    $value->code = '';
                    $value->discount = false;
                } else {
                    $value->code = $code[0]->customer_code;
                    if (($code[0]->point + 1) % 5 == 0) {
                        $value->discount = true;
                    } else {
                        $value->discount = false;
                    }
                }
            }

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $col = new Collection($data);
            $perPage = 10;
            $currentPageSearchResult = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $data = new LengthAwarePaginator($currentPageSearchResult, count($col), $perPage);
            return view('pagination_online_admin', compact('data'))->render();
        }
    }

    function fetch_data_dropin(Request $request)
    {
        $this->update_dropin_data();
        if ($request->ajax()) {
            $input = $request->all();
            $data = DB::table('drop_in_reservations')->whereNull('deleted_at');
            if (isset($input['status']) && !empty($input['status'])) {
                foreach ($input['status'] as $key => $status) {
                    $input['status'][$key] = strtolower($status);
                }
                $data = $data->whereIn('status', $input['status']);
            }
            if (isset($input['service_type']) && !empty($input['service_type'])) {
                foreach ($input['service_type'] as $key => $service_type) {
                    $input['service_type'][$key] = strtolower($service_type);
                }
                $data = $data->whereIn('type', $input['service_type']);
            }

            if (isset($input['day']) && $input['day'] != null) {
                $validation = Validator::make($input, [
                    'day' => 'date|date_format:Y-m-d'
                ]);
                if ($validation->fails()) {
                    return $validation->messages();
                }
                $data = $data->whereDate('created_at', date('Y-m-d', strtotime($input['day'])));
            } else {
                $today = date('Y-m-d');
                $data = $data->whereDate('created_at', $today);
            }
            $data = $data->orderBy('created_at', 'asc');
            $data = $data->get()->toArray();
            foreach ($data as $value) {
                $code = DB::table('customers')
                    ->where('email', $value->email)->get();
                if ($code->isEmpty()) {
                    $value->code = '';
                    $value->discount = false;
                } else {
                    $value->code = $code[0]->customer_code;
                    if (($code[0]->point + 1) % 5 == 0) {
                        $value->discount = true;
                    } else {
                        $value->discount = false;
                    }
                }
            }
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $col = new Collection($data);
            $perPage = 10;
            $currentPageSearchResult = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $data = new LengthAwarePaginator($currentPageSearchResult, count($col), $perPage);

            return view('pagination_dropin_admin', compact('data'))->render();
        }
    }
}
