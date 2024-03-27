<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'mobile' => 'required|max:10',
            'city' => 'required',
            'pincode' => [
                'required',
                'digits:6',
                'exists:pincodes,pincode',
                function ($attribute, $value, $fail) {
                    // Check if the pincode status is 1
                    $pincodeStatus = Pincode::where('pincode', $value)->value('status');
                    if ($pincodeStatus != 1) {
                        $fail('Pincode is not serviceable.');
                    }
                },
            ],
            'address' => 'required',
            'password' => 'required'
        ];

        $message = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please Enter Valid Email Address',
            'email.unique' => 'Email already in use',
            'mobile.required'=> 'Contact is required',
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

        $unique_id = User::count()+1;
        $user->unique_id = 'USR-' . str_pad($unique_id, 3, '0', STR_PAD_LEFT);
        
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
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 1) {
                return redirect()->route('dashboard')->withSuccess('You have signed in.');
            } else {
                return redirect()->route('user.dashboard')->withSuccess('You have signed in.');
            }
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    // if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')]) || Auth::attempt(['email' => request('email'), 'password' => request('password')]) || Auth::attempt(['name' => request('name'), 'password' => request('password')]) ||  Auth::attempt(['anyOtherField' => request('anyOtherField'), 'password' => request('password')]) ){....Action...}

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

