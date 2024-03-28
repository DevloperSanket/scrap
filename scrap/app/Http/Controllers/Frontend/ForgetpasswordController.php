<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class ForgetpasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.forget');
    }

    public function setotp(Request $request)
    {
        if ($request->session()->has('otp')) {
            return view('frontend.setotp');
        } else {
            return view('frontend.login');
        }
    }

    public function chengePassword(Request $request)
    {
        if ($request->session()->has('otp')) {
            return view('frontend.change-password');
        } else {
            return view('frontend.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        $messages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email is not associated with any account.',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found for the provided email.',
            ], 404);
        }


        $userId = $user->id;


        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in the session
        $request->session()->put('otp', $otp);
        $request->session()->put('userid', $userId);

        // Compose email content
        $title = "Reset Your Password";
        $body = "Hi {$validatedData['email']},<br><br>Your new OTP is $otp.";

        $sendData = new Request([
            'email'=>$validatedData['email'],
            'otp'=>$otp,

        ]);
        // Send email
        Mail::to($validatedData['email'])->send(new ForgetPassword($sendData));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to the registered email.',
        ]);
    }


    public function matchotp(Request $request)
    {

        $rules = [
            'otp' => 'required|digits:6',
        ];

        $messages = [
            'otp.required' => 'OTP is required.',
            'otp.digits' => 'Please enter a valid 6-digit OTP.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $storedOtp = $request->session()->get('otp');

        if ($storedOtp == $validatedData['otp']) {
            return response()->json([
                'success' => true,
                'message' => 'OTP matched successfully.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => [
                    'otp' => ['Invalid OTP. Please try again.']
                ]
            ], 422);
        }
    }

    public function Resetpassword(Request $request)
    {
        $rules = [
            'password' => 'required',
            'password-confirm' => 'required|same:password',
        ];

        $messages = [
            'password.required' => 'Password is required.',
            'password-confirm.required' => 'Confirm password is required',
            'password-confirm.same' => 'The password confirmation does not match the password.',
        ];

        $validatedData = $request->validate($rules, $messages);

        // $storedOtp = $request->session()->get('otp');
        $storedId = $request->session()->get('userid');
        $newpassword = User::findOrFail($storedId);

        $newpassword->password = Hash::make($validatedData['password-confirm']);
        $newpassword->save();

        $request->session()->forget('userid');

        $request->session()->forget('otp');
        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.',
        ]);
        
    }
}
