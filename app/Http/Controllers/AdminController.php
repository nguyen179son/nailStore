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


    function fetch_data_online(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $data = DB::table('online_reservations')->whereNull('deleted_at');
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
                $today = Carbon::now()->subDay()->format('Y-m-d');
                $data = $data->whereDate('reservation_time', $today);

            }


            $data = $data->orderBy('reservation_time', 'asc');
            $data = $data->get()->toArray();
            foreach ($data as $value) {
                $code = DB::table('customers')
                    ->where('email', $value->email)->get();
                if (!empty($code)) {
                    $value->code = $code[0]->customer_code;
                } else {
                    $value->code = '';
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
                $today = Carbon::now()->subDay()->format('Y-m-d');
                $data = $data->whereDate('created_at', $today);
            }
            $data = $data->orderBy('created_at', 'asc');
            $data = $data->get()->toArray();
            foreach ($data as $value) {
                $code = DB::table('customers')
                    ->where('email', $value->email)->get();
                if (!empty($code)) {
                    $value->code = $code[0]->customer_code;
                } else {
                    $value->code = '';
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
