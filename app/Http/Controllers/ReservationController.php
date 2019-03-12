<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Client;

class ReservationController extends Controller
{
    public function getReservations() {
        $mbox = imap_open ("{imap.gmail.com:993/imap/ssl}INBOX", "labella.collector@gmail.com", "uppsala123");
        if($mbox === false){
            //If it failed, throw an exception that contains
            //the last imap error.
            return "loooix cmnr";
        }
        $search = 'SINCE "' . date("j F Y", strtotime("-2 days")) . '"';
        $emails = imap_search($mbox, $search);
//        $folders = imap_listmailbox($mbox, "{imap.gmail.com:993/imap/ssl}", "*");
        $email_list = array();
        if(!empty($emails)){
            //Loop through the emails.
            foreach($emails as $email){
                //Fetch an overview of the email.
                $overview = imap_fetch_overview($mbox, $email);
                $overview = $overview[0];

                $email_number = $overview->msgno;
                $inserted_record = DB::table("online_reservations")->where('mail_number', $email_number)->first();
                if ($inserted_record) {
                    continue;
                }

                $header = imap_headerinfo($mbox,$email_number);
                $from_host = $header->from[0]->host;
                if ($from_host != "bokadirekt.se") continue;

                $subject = strtolower($header->subject);
                if ($subject == "ny bokning") {
                    $mail_type = "book";
                } else if (strpos($subject, 'avbokning') !== false){
                    $mail_type = "cancel";
                } else continue;

                $message = (imap_fetchbody($mbox,$email_number,1.1));
                if($message == '')
                {
                    $message = (imap_fetchbody($mbox,$email_number,1));
                }
                $message = quoted_printable_decode($message);

                $lines = explode("\r\n", $message);
//                dd($lines);
                foreach ($lines as $line) {
                    if (strpos($line, 'Kundens namn') !== false) {
                        $customer_name = ltrim($line, "Kundens namn: ");
                        continue;
                    }
                    if (strpos($line, 'Mobil') !== false) {
                        $customer_phone = ltrim($line, "Mobil: ");
                        continue;
                    }
                    if (strpos($line, 'Tidpunkt') !== false) {
                        $customer_booking_time = ltrim($line, "Tidpunkt: ").":00";
                        continue;
                    }
                    if (strpos($line, 'Tjänst') !== false) {
                        $customer_duration = (substr($line, -6, 2));
                        if (strpos($line, 'Nagel') !== false) {
                            $customer_service = "mong";
                            continue;
                        }
                        if (strpos($line, 'Singel') !== false) {
                            $customer_service = "mi";
                            continue;
                        }
                        if (strpos($line, 'Manikyr') !== false) {
                            $customer_service = "chan";
                            continue;
                        }
                    }
                    if (strpos($line, 'meddelande') !== false) {
                        $customer_notice = ltrim($line, "Ev. meddelande: ");
                    }
                }

//                DB::table("online_reservations")->insertGetId([
//
//                ]);


                array_push($email_list, $message);


            }
        }
        imap_close($mbox);
        dd($email_list);

    }
}
