<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\pincode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MyprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        if (Auth::check()) {

            $userId = Auth::id();
            $user = User::findOrFail($userId);
        }
        return view('UserAdmin.Myprofile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function edit()
    {

        if (Auth::check()) {
            $userId = Auth::id();
            $user = User::findOrFail($userId);
        }
        return view('UserAdmin.Myprofile.edit', compact('user'));
    }





    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'mobile' => 'required|max:10',
            'city' => 'required',
            'pincode' =>  [
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
        ];
        $validateData = $request->validate($rules, $message);



        $user = User::find($request->id);

        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->mobile = $validateData['mobile'];
        $user->city = $validateData['city'];
        $user->pincode = $validateData['pincode'];
        $user->address = $validateData['address'];
 
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Updated successfully',
        ]);
    }






    public function editpassword()
    {

        if (Auth::check()) {

            $userpasswordId = Auth::id();
            $userpassword = User::findOrFail($userpasswordId);
        }

        return view('UserAdmin.Myprofile.editpassword', compact('userpassword'));
    }



    public function updatePassword(Request $request)
    {
        $rules = [
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed',
        ];

        $messages = [
            'oldpassword.required' => 'The current password is required.',
            'newpassword.required' => 'The new password is required.',
            'newpassword.min' => 'The new password must be at least 8 characters.',
            'newpassword.confirmed' => 'The new password confirmation does not match.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = User::find(auth()->user()->id);

        if (!Hash::check($validatedData['oldpassword'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The current password is incorrect.',
            ], 422);
        }

        $user->password = Hash::make($validatedData['newpassword']);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.',
        ]);
    }

  
}
