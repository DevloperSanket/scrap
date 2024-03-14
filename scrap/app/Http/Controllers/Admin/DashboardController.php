<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $allregisterUser = User::where('role',2)->count();
            // dd($allregisterUser);

            $activeUser = User::where('status', 1)
                       ->where('role', 2)
                       ->count();

            $deactiveUser = User::where('status',0)->where('role',2)->count();
            
            return view('admin.dashboard.index',compact('allregisterUser','activeUser','deactiveUser'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function showTable(){
        return view('admin.dashboard.show');
    }

    public function data(){
        $users = User::where('role',2)->get();

        return DataTables::of($users)
        ->addColumn('name', function ($users) {
            return $users->name;
        })
        ->addColumn('email', function ($users) {
            return $users->email;
        })
        ->addColumn('city', function ($users) {
            return $users->city;
        })
        ->addColumn('pincode', function ($users) {
            return $users->pincode;
        })
        ->addColumn('address', function ($users) {
            return $users->address;
        })
        ->addColumn('status', function ($users) {
            $status = '<div class="form-check form-switch">
           <input class="form-check-input text-center" type="checkbox" ' . ($users->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $users->id . '" onchange="ScrapStatusChange(' . $users->id . ')">
        </div>';
            return $status;
        })
        ->rawColumns(['action', 'status','name','email','city','pincode','address'])
        ->make(true);

    }

    public function changeUserStatus(Request $request){
        $id = $request->id;
        $status = $request->status;
        $query = User::where('id',$id)->update(['status'=>$status]);
        if($query){
            return response()->json([
                'success'=> true,
                'data'=>$query,
                'message' => 'Status updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Doctor record not found or status unchanged'], 404);
        }
    }
}
