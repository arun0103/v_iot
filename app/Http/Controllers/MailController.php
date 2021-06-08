<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function sendWelcomeUser(Request $req){
        $data = new \stdClass();
        $data->user_name = $req->receiver_name;
        $data->user_email = $req->receiver_email;
        $data->user_password = $req->receiver_password;
        $data->sender_name = "Guillermo Zarruk";
        $data->sender_email = "noreply@viot.com";

        return Mail::to($user_email)->send(new WelcomeUser($data));
    }
}
