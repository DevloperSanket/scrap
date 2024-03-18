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
        ]);

          // Return a JSON response
          return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Driver Added successfully',
        ]);

    }

    public function edit(string $id){

        $driver_edit = Driver::find($id);
        return view('admin.driver.edit',compact('driver_edit'));
    }

    public function update(Request $request){

        $updatedata = Driver::find($request->id);

        $updatedata->name = $request->input('name');
        $updatedata->mobile = $request->input('mobile');

        $updatedata->save();

          // Return a JSON response
          return response()->json([
            'success' => true,
            'data' => $updatedata,
            'message' => 'Driver Updated successfully',
        ]);
    }

    public function delete(Request $request)
    {
        // dd($request);
        $deleterecord = Driver::find($request->id);
        // dd($deleterecord);
        $deleterecord->delete();
        
          return response()->json([
            'success' => true,
            'data' => $deleterecord,
            'message' => 'Driver Deleted successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DriverchangeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $query = Driver::where('id',$id)->update(['status'=>$status]);
        if($query){
            return response()->json([
                'success'=> true,
                'data'=>$query,
                'message' => 'Status updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Record not found or status unchanged'], 404);
        }
    }
}
