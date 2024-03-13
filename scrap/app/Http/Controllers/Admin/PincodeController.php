<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;
use Illuminate\Validation\Rule;
use DataTables;

class PincodeController extends Controller
{
    public function index(){

        return view('admin.pincode.index');
    }
}
