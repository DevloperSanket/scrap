<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    //
    public function sendEmail(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $message = $request->input('message');

        // Instantiate PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'pal.mahesh3122@gmail.com';                     // SMTP username
            $mail->Password   = 'ttir obpb nfxc xypu';                         // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('pal.mahesh3122@gmail.com', 'mahesh');
            $mail->addAddress('sanket.saveasweb24@gmail.com', 'sanketSave');     // Add a recipient

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Contact Form Submission';
            $mail->Body    = "Name: $name<br>Email: $email<br>Mobile: $mobile<br>Message: $message";

            $mail->send();
            return redirect()->back()->with('success', 'Message has been sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
