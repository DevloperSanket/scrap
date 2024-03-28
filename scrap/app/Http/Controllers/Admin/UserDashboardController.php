<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterdSell;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            
            $userScrap = RegisterdSell::where('user_id', $userId)->get();

            $allScrap = $userScrap->count();
            $pendingScrap = $userScrap->where('status', 1)->count();
            $acceptedScrap = $userScrap->where('status', 2)->count();
            $completedScrap = $userScrap->where('status', 3)->count();

            return view('UserAdmin.Dashboard.index', compact('allScrap', 'pendingScrap', 'acceptedScrap', 'completedScrap'));
        }
        return redirect("login")->withSuccess('Oops! You do not have access');
    }


   
    public function store(Request $request)
    {
        //
    }

   
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

  
    public function destroy(string $id)
    {
        //
    }
}
