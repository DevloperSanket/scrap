<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Validation\Rule;
use DataTables;


class DriverController extends Controller
{
    public function index(){
        return view('admin.driver.index');
    }

    public function create(){
        return view('admin.driver.form');
    }

    public function driverdata(){
        
        $query = Driver::query();

        return Datatables::of($query)
        ->addColumn('name', function ($query) {
            return $query->name;
        })

        ->addColumn('mobile', function ($query){
            return $query->mobile;
        })

        ->addColumn('action', function ($query){

            $editButton = '<a href="' . route('driver.edit', $query->id) . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>';
            $deleteButton = '<a class="delete btn btn-danger btn-sm" onclick="deletefunction(' . $query->id .')"><i class="bi bi-trash3"></i></a>';
        
            return $editButton . ' ' . $deleteButton;
        })

        ->addColumn('status', function ($query) {
            $status = '<div class="form-check form-switch">
           <input class="form-check-input text-center" type="checkbox" ' . ($query->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $query->id . '" onchange="DriverStatusChange(' . $query->id . ')">
        </div>';
            return $status;
        })
        

        ->rawColumns(['action', 'status', 'name', 'mobile'])
        ->make(true);
    }

    public function store(Request $request){

        // validation rules
        $rules = [
            'name' => 'required',
            'mobile' => 'required',
        ];

        // Custom error messages
        $messages = [
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile is required',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        $data = Driver::create([
            'name' => $validatedData['name'],
            'mobile' => $validatedData['mobile'],
            'status' => '1',
        ]);

          // Return a JSON response
          return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Driver Added successfully',
        ]);

    }
}