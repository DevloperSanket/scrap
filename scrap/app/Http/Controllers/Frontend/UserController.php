<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Mail;
use App\Models\Pincode;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login()
    {
        return view('frontend.login');
    }

    public function register()
    {
        return view('frontend.register');
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'mobile' => [
                'required',
                'max:10',
                'regex:/^\d{10}$/',
                Rule::unique('users')
            ],
            'city' => 'required',
            'pincode' => [
                'required',
                'digits:6',
                'exists:pincodes,pincode',
                'valid_pincode',
            ],
            'address' => 'required',
            'password' => 'required'
        ];

        $message = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please Enter Valid Email Address',
            'email.unique' => 'Email already in use',
            'mobile.required' => 'Contact is required',
            'city.required' => 'City is required',
            'pincode.required' => 'Pincode is required',
            'address.required' => 'Address is required',
            'password.required' => 'Password is required'
        ];
        $validateData = $request->validate($rules, $message);

        // dd($request);
        $user = new User;
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->mobile = $validateData['mobile'];
        $user->city = $validateData['city'];
        $user->pincode = $validateData['pincode'];
        $user->address = $validateData['address'];
        $user->role = $request->role;
        $user->password = Hash::make($validateData['password']);

        $unique_id = User::count() + 1;
        $user->unique_id = 'USR-' . str_pad($unique_id, 3, '0', STR_PAD_LEFT);

        Mail::to($validateData['email'])->send(new ForgetPassword($sendData));
        $user->save();

        

        // dd($user);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('dashboard')->withSuccess('You have signed in.');
            } else {
                return redirect()->route('user.dashboard')->withSuccess('You have signed in.');
            }
        }
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Attempt to authenticate using either email or mobile
        if (
            Auth::attempt(['email' => $username, 'password' => $password]) ||
            Auth::attempt(['mobile' => $username, 'password' => $password])
        ) {

            $user = Auth::user();

            if ($user->role == 1) {
                return redirect()->route('dashboard')->withSuccess('You have signed in.');
            } else {
                return redirect()->route('user.dashboard')->withSuccess('You have signed in.');
            }
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
