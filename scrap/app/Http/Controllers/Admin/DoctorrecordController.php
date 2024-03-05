<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorRecord;
use Illuminate\Validation\Rule;
use DataTables;

class DoctorrecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Doctor.index');
    }

    public function data()
    {
        $query = DoctorRecord::query();

        return DataTables::eloquent($query)
            ->addColumn('name', function ($doctorrecord) {
                return $doctorrecord->name;
            })
            ->addColumn('email', function ($doctorrecord) {
                return $doctorrecord->email;
            })
            ->addColumn('contact', function ($doctorrecord) {
                return $doctorrecord->contact;
            })
            ->addColumn('city', function ($doctorrecord) {
                return $doctorrecord->city;
            })
            ->addColumn('pincode', function ($doctorrecord) {
                return $doctorrecord->pincode;
            })
            ->addColumn('address', function ($doctorrecord) {
                return $doctorrecord->address;
            })
            ->addColumn('description', function ($doctorrecord) {
                return $doctorrecord->description;
            })
            ->addColumn('action', function ($doctorrecord) {
                $btn = '<a href="#" class="edit btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('status', function ($doctorrecord) {
                $status = '<div class="form-check form-switch">
                   <input class="form-check-input" type="checkbox" ' . ($doctorrecord->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $doctorrecord->id . '" onchange="statusChange(' . $doctorrecord->id . ')">
                </div>';
                return $status;
            })


            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Doctor.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'contact' => 'required|min:10|numeric',
            'city' => 'required',
            'pincode' => 'required|min:6|numeric',
            'address' => 'required',
            'description' => 'required',
        ];

        $message = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please Enter Valid Email Address',
            'email.unique' => 'Email already in use',
            'contact.required' => 'Contact is required',
            'city.required' => 'City is required',
            'pincode.required' => 'Pincode is required',
            'address.required' => 'Address is required',
            'description.required' => 'Description is required',
        ];

        $validateData = $request->validate($rules, $message);

        // dd($request->all());
        $data = new DoctorRecord;
        $data->name = $validateData['name'];
        $data->email = $validateData['email'];
        $data->contact = $validateData['contact'];
        $data->city = $validateData['city'];
        $data->pincode =  $validateData['pincode'];
        $data->address = $validateData['address'];
        $data->description = $validateData['description'];

        $data->save();

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Data Create Successfully',
        ]);
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
        return view('admin.Doctore.form');
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
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $query = DoctorRecord::where('id',$id)->update(['status'=>$status]);
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
