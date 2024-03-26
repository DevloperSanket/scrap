<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    // public function sendEmail()
    // {
       

    //     $title = 'Welcome to the laracoding.com example email';
    //     $body = 'Thank you for participating!';

    //     Mail::to('sanket.saveasweb24@gmail.com')->send(new WelcomeMail($title, $body));

    //     return "Email sent successfully!";
    // }
}
