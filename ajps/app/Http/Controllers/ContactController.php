<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use PHPMailer\PHPMailer\PHPMailer;
use Carbon\Carbon;

require base_path('vendor/autoload.php');

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jpablobscs@tfvc.edu.ph'; 
            $mail->Password   = 'anvk fiku vavo sxnt'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('jpablobscs@tfvc.edu.ph', 'Adrenaline Junky Piercinks');
            $mail->addAddress('jpablobscs@tfvc.edu.ph', 'Mr.kyowa');
            $mail->addReplyTo($request->email, $request->firstname . ' ' . $request->lastname);

            $mail->isHTML(true);
            $mail->Subject = 'New Tattoo Appointment Inquiry';
            $mail->Body    = "
                <h2>New Contact Form Submission</h2>
                <p><b>Name:</b> {$request->firstname} {$request->lastname}</p>
                <p><b>Email:</b> {$request->email}</p>
                <p><b>Phone:</b> {$request->phone}</p>
                <p><b>Date:</b> {$request->date}</p>
                <p><b>Time:</b> {$request->time}</p>
                <p><b>Service:</b> {$request->service}</p>
                <p><b>Info:</b> {$request->info}</p>
            ";

            $mail->send();



Reservation::create([
    'first_name'     => $request->firstname,
    'last_name'      => $request->lastname,
    'email'          => $request->email,
    'phone'          => $request->phone,
    'preferred_date' => $request->date,
    'preferred_time' => Carbon::parse($request->time)->format('H:i:s'), // 👈 convert to 24hr
    'service'        => $request->service,
    'instruction'    => $request->info,
]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Message could not be sent. Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
