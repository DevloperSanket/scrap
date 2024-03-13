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

    public function create()
    {
        return view('admin.pincode.form');
    }

    public function pincodedata(){

        $query = Pincode::query();

        return Datatables::of($query)
        ->addColumn('city', function ($query) {
            return $query->city;
        })

        ->addColumn('action', function ($query){
            $editButton = '<a href="' . route('pincode.edit', $query->id) . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>';
            $deleteButton = '<a class="delete btn btn-danger btn-sm" onclick="deletefunction(' . $query->id .')"><i class="bi bi-trash3"></i></a>';
        
            return $editButton . ' ' . $deleteButton;
        })

        ->addColumn('status', function ($query) {
            $status = '<div class="form-check form-switch">
           <input class="form-check-input text-center" type="checkbox" ' . ($query->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $query->id . '" onchange="pincodeStatusChange(' . $query->id . ')">
        </div>';
            return $status;
        })
        
        ->rawColumns(['action', 'status'])
        ->make(true);
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'pincode' => ['required', Rule::unique('pincodes')],
        ];

        // Custom error messages
        $messages = [
            'pincode.required' => 'Pincode is required',
            'pincode.unique' => 'This Pincode is already available',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        // Create a new ScrapCategories instance
        $scrapCategory = new Pincode;
        

        $data = Pincode::create([
            'pincode' => $validatedData['pincode'],
            'status' => '1',
        ]);

        

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Category created successfully',
        ]);
    }


}
