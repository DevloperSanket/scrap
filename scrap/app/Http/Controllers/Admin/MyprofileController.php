<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MyprofileController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {

        if ( Auth::check() ) {

            $userId = Auth::id();
            $user = User::findOrFail( $userId );

        }
        return view( 'UserAdmin.Myprofile.index', compact( 'user' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function edit() {

        if ( Auth::check() ) {

            $userId = Auth::id();
            $user = User::findOrFail( $userId );
            // $user_edit = $user->id;
            // dd($user_edit);


        }
        return view( 'UserAdmin.Myprofile.edit',compact('user'));
    }

  

    public function update(Request $request)
{
    $updatedata = User::find($request->id)->update($request->all());

    // $updatedUser = User::find($request->id);

    // Return a JSON response
    return response()->json([
        'success' => true,
        'data' => $updatedata,
        'message' => 'Updated successfully',
    ]);
}



  

    public function editpassword() {

        if ( Auth::check() ) {

            $userpasswordId = Auth::id();
            $userpassword = User::findOrFail( $userpasswordId );

        }
      
        return view( 'UserAdmin.Myprofile.editpassword',compact('userpassword'));
    }



    public function updatePassword(Request $request)
{
    $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirmpassword' => 'required|same:newpassword',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->oldpassword, $user->password)) {
        return response()->json(['errors' => ['oldpassword' => ['The old password is incorrect.']]], 422);
    }

    $user->password = Hash::make($request->newpassword);
    $user->save();

    return response()->json(['success' => true], 200);
}

  
}
