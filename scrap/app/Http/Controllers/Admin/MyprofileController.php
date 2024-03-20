<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        // dd($request);
        
        $updatedata = User::find($request->id);
        // dd( $updatedata);
        $updatedata->name = $request->input('name');
        $updatedata->email = $request->input('email');
        $updatedata->mobile = $request->input('mobile');
        $updatedata->name = $request->input('city');
        $updatedata->email = $request->input('pincode');
        $updatedata->mobile = $request->input('address');


        $updatedata->save();

         // Return a JSON response
         return response()->json([
            'success' => true,
            'data' => $updatedata,
            'message' => 'Updated successfully',
        ]);
    }


    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

  

    // public function editpassword() {
      
    //     return view( 'UserAdmin.Myprofile.form' );
    // }

  
    // public function updatePassword( Request $request ) {
    //     $request->validate( [
    //         'oldpassword' => 'required',
    //         'newpassword' => 'required',
    //         'confirmpassword' => 'required|same:newpassword',
    //     ] );

    //     $user = Auth::user();

    //     if ( !Hash::check( $request->oldpassword, $user->password ) ) {
    //         return redirect()->back()->with( 'error', 'The old password is incorrect.' );
    //     }

    //     $user->password = Hash::make( $request->newpassword );
    //     $user->save();

    //     return redirect()->back()->with( 'success', 'Password updated successfully.' );
    // }

   
    public function destroy( string $id ) {
        //
    }
}
