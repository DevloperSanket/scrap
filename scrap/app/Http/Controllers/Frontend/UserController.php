<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
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
            'city'=> 'required',
            'pincode'=> 'required',
            'address'=> 'required',
            'password' => 'required'
        ];

        $message = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please Enter Valid Email Address',
            'email.unique' => 'Email already in use',
            'city.required' => 'City is required',
            'pincode.required'=> 'Pincode is required',
            'address.required'=> 'Address is required',
            'password.required' => 'Password is required'
        ];
        $validateData = $request->validate($rules,$message);

        // dd($request);
        $user = New User;
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->city = $validateData['city'];
        $user->pincode = $validateData['pincode'];
        $user->address = $validateData['address'];
        $user->role = $request->role;
        $user->password = Hash::make($validateData['password']);
        $user->save();
        if(Auth::attempt($request->only('email','password'))){
            return redirect('dashboard')->withSuccess('You have signed-in');
        }
    }

    public function signin(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // dd($request);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
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

    public function logout(){
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }


  

    
}
