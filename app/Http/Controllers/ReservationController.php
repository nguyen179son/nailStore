<?php

namespace App\Http\Controllers;

use App\DropInReservations;
use App\OnlineReservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Webklex\IMAP\Client;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function getReservations()
    {
        try {
            $mbox = imap_open("{imap.gmail.com:993/imap/ssl}INBOX", "labella.collector@gmail.com", "uppsala123");
        } catch (\Exception $e) {
            return abort(500);
        }
        if ($mbox === false) {
            return "Error opening mailbox";
        }
        $search = 'SINCE "' . date("j F Y", strtotime("-0 days")) . '"';
        $emails = imap_search($mbox, $search);

        $email_list = array();
        if (!empty($emails)) {
            //Loop through the emails.
            foreach ($emails as $email) {
                //Fetch an overview of the email.
                $overview = imap_fetch_overview($mbox, $email);
                $overview = $overview[0];

                $email_number = $overview->msgno;
                $inserted_record = DB::table("online_reservations")->where('mail_number', $email_number)->first();
                if ($inserted_record) {
                    continue;
                }

                $header = imap_headerinfo($mbox, $email_number);
                $from_host = $header->from[0]->host;
                if ($from_host != "bokadirekt.se") continue;


                $message = (imap_fetchbody($mbox, $email_number, 1.1));
                if ($message == '') {
                    $message = (imap_fetchbody($mbox, $email_number, 1));
                }

                $message = imap_qprint($message);
                $message = utf8_encode($message);

                $lines = explode("\r\n", $message);
                $subject = strtolower($header->subject);
                if ($subject == "ny bokning") {
                    $this->handleNewBookingMail($lines, $email_number);
                    continue;
                } else if (strpos($subject, 'avbokning') !== false) {
                    $this->handleCancelBookingMail($lines, $email_number);
                    continue;
                } else continue;

//                array_push($email_list, $message);


            }
        }
        imap_close($mbox);
        return response("", 200);
//        dd($email_list);

    }

    public function handleNewBookingMail($lines, $email_number)
    {
        $mail_type = "book";
        $customer_name = $customer_email = $customer_mobile = $customer_telephone
            = $customer_booking_time = $customer_duration = $customer_service = $customer_notice = "";
        foreach ($lines as $line) {
            if (strpos($line, 'Kundens namn') !== false) {
                $customer_name = json_encode(mb_strtolower(trim(str_replace("Kundens namn: ", "", $line), "\t ")));
                continue;
            }
            if (strpos($line, 'Mobil') !== false) {
                $customer_mobile = trim(str_replace("Mobil: ", "", $line), "\t ");
                continue;
            }
            if (strpos($line, 'Telefon') !== false) {
                $customer_telephone = trim(str_replace("Telefon: ", "", $line), "\t ");
                continue;
            }
            if (strpos($line, 'Epost') !== false) {
                $customer_email = trim(str_replace("Epost: ", "", $line), "\t ");
                continue;
            }
            if (strpos($line, 'Tidpunkt') !== false) {
                if (preg_match("/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]/", $line, $m)) {
                    $customer_booking_time = $m[0]. ":00";
                };
                continue;
            }
            if (preg_match("/(\d+) min/", $line, $m)) {
                $customer_duration = $m[1];
                if (strpos($line, 'Nagel') !== false || strpos($line, 'Manikyr') !== false) {
                    $customer_service = "Naglar";
                    continue;
                }
                if (strpos($line, 'fransar') !== false) {
                    $customer_service = "Fransar";
                    continue;
                }
                if (strpos($line, 'Pedikyr') !== false) {
                    $customer_service = "Pedikyr";
                    continue;
                }
            }
            if (strpos($line, 'meddelande') !== false) {
                $customer_notice = json_encode(mb_strtolower(trim(str_replace("Ev. meddelande: ", "", $line), "\t ")));
                continue;
            }

        }


        DB::table("online_reservations")->insert([
            'mobile' => $customer_mobile,
            'telephone' => $customer_telephone,
            'email' => $customer_email,
            'reservation_time' => $customer_booking_time,
            'customer_name' => $customer_name,
            'type' => $mail_type,
            'duration' => $customer_duration,
            'service_type' => $customer_service,
            'notice' => $customer_notice,
            'mail_number' => $email_number,
            'status' => 'waiting',
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function handleCancelBookingMail($lines, $email_number)
    {
        $mail_type = "cancel";
        $customer_name = $customer_email = $customer_mobile = $customer_telephone
            = $customer_booking_time = $customer_duration = $customer_service = $customer_notice = "";
        foreach ($lines as $line) {
            if (strpos($line, 'Kundens namn') !== false) {
                $customer_name = json_encode(mb_strtolower(trim(str_replace("Kundens namn: ", "", $line), "\t ")));
                continue;
            }
            if (strpos($line, 'Mobil') !== false) {
                $customer_mobile = trim(str_replace("Mobil: ", "", $line), "\t ");
                continue;
            }
            if (strpos($line, 'Telefon') !== false) {
                $customer_telephone = trim(str_replace("Telefon: ", "", $line), "\t ");
                continue;
            }
            if (strpos($line, 'Epost') !== false) {
                $customer_email = trim(str_replace("Epost: ", "", $line), "\t ");
                continue;
            }
            if (strpos($line, 'har avbokats') !== false) {
                if (preg_match("/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]/", $line, $m)) {
                    $customer_booking_time = $m[0]. ":00";
                };
                if (strpos($line, 'Nagel') !== false || strpos($line, 'Manikyr') !== false) {
                    $customer_service = "Naglar";
                    continue;
                }
                if (strpos($line, 'fransar') !== false) {
                    $customer_service = "Fransar";
                    continue;
                }
                if (strpos($line, 'Pedikyr') !== false) {
                    $customer_service = "Pedikyr";
                    continue;
                }

            }
            if (strpos($line, 'Avbokningsmeddelande') !== false) {
                $customer_notice = json_encode(mb_strtolower(trim(str_replace("Avbokningsmeddelande: ", "", $line), "\t ")));
                continue;
            }
        }

        dd($customer_name);
        DB::table("online_reservations")->where([
            ['customer_name', '=', $customer_name],
            ['reservation_time', '=', $customer_booking_time],
            ['service_type', '=', $customer_service],
            ['type', '=', "book"]
        ])->update(["deleted_at" => date('Y-m-d H:i:s')]);

        DB::table("online_reservations")->insertGetId([
            'mobile' => $customer_mobile,
            'telephone' => $customer_telephone,
            'email' => $customer_email,
            'reservation_time' => $customer_booking_time,
            'customer_name' => $customer_name,
            'type' => $mail_type,
            'duration' => $customer_duration,
            'service_type' => $customer_service,
            'notice' => $customer_notice,
            'mail_number' => $email_number,
            'status' => 'removed',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    function fetch_data(Request $request)
    {

        if ($request->ajax()) {
            $input = $request->all();
            if (isset($input['day']) && $input['day'] != null) {
                $validation = Validator::make($input, [
                    'day' => 'required|date|date_format:Y-m-d'
                ]);
                if ($validation->fails()) {
                    return $validation->messages();
                }
                $data = DB::table("online_reservations")->whereNull('deleted_at')
                    ->where('reservation_time','>',date('Y-m-d H:i:s'))
                    ->whereIn('status',['waiting'])
                    ->whereDate('reservation_time', date('Y-m-d', strtotime($input['day'])))
                    ->orderBy('reservation_time', 'asc');

            } else {
                $today = date('Y-m-d');
                $data = DB::table("online_reservations")
                    ->whereIn('status',['waiting'])
                    ->whereNull('deleted_at')
                    ->whereDate('reservation_time', $today)
                    ->where('reservation_time','>',date('Y-m-d H:i:s'))
                    ->orderBy('reservation_time', 'asc');

            }
            $data = $data->paginate(10);
            return view('pagination_online_reservations', compact('data'))->render();
        }
    }

    public function count(Request $request)
    {
        $input = $request->query();
        if (isset($input['day']) && $input['day'] != null) {

            $validation = Validator::make($input, [
                'day' => 'date|date_format:Y-m-d'
            ]);
            if ($validation->fails()) {
                return $validation->messages();
            }
            $reservations = DB::table("online_reservations")
                ->whereNull('deleted_at')
                ->whereIn('status',['waiting'])->get();
            foreach ($reservations as $key => $reservation) {
                if (date('Y-m-d', strtotime($reservation->reservation_time)) != date('Y-m-d', strtotime($input['day']))) {
                    unset($reservations[$key]);
                }
            }
            return $reservations->count();
        } else {
            $today = date('Y-m-d');
            $reservations = DB::table("online_reservations")
                ->where('reservation_time','>',date('Y-m-d H:i:s'))
                ->whereIn('status',['waiting'])
                ->whereNull('deleted_at')->get();
            foreach ($reservations as $key => $reservation) {
                if (date('Y-m-d', strtotime($reservation->reservation_time)) != $today) {
                    unset($reservations[$key]);
                }
            }
            return $reservations->count();
        }

    }

    public function destroy($id)
    {
        $res = OnlineReservations::find($id);
        $res->delete();
        return response()->json(['success' => 'Record is successfully deleted']);
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
        DB::table('online_reservations')->where('id', '=', $input['id'])->update(array('status'=> $input['status']));
        $res = DB::table('online_reservations')->where('id',$input['id'])->get()[0];
        $member = DB::table('customers')->where('email',$res->telephone)->get();
        if ($member->isEmpty()) {
            return response()->json([]);
        }
        if (($member[0]->point + 1) % 5 == 0) {
            return response()->json(['discount'=>true]);
        }
        return response()->json([]);
    }

    public function checkout($id,Request $request) {
        $input = $request->all();
        $validation = Validator::make($input, [
            'receipt' => 'required|numeric|max:100000',
            'note' => 'max:100',
            'staff' => 'required|max:100',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->messages()]);
        }

        $reservation = OnlineReservations::find($id);
        if ($reservation) {
            foreach ($input as $key => $value) {
                $reservation->$key = $value;
            }
        }
        $reservation->save();
        return response()->json(['success' => '']);
    }
}
