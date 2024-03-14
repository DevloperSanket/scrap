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

        ->addColumn('area', function ($query) {
            return $query->area;
        })

        ->addColumn('pincode', function ($query) {
            return $query->pincode;
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
        
        ->rawColumns(['action', 'status','city','area','pincode'])
        ->make(true);
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'pincode' => ['required', Rule::unique('pincodes'),'min:6'],
            'city' => ['required'],
            'area' => ['required'],
        ];

        // Custom error messages
        $messages = [
            'pincode.required' => 'Pincode is required maximum 6 numbers',
            'pincode.unique' => 'This Pincode is already available',
            'city.required' => 'City is required',
            'area.required' => 'Area is required',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        // Create a new ScrapCategories instance
        // $scrapCategory = new Pincode;
        

        $data = Pincode::create([
            'pincode' => $validatedData['pincode'],
            'city' => $validatedData['city'],
            'area' => $validatedData['area'],
            'status' => '1',
        ]);

        

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Form Submitted successfully',
        ]);
    }

    public function edit(string $id){

        $pincode_edit = Pincode::find($id);
        // dd($pincode_edit);
        return view('admin.pincode.edit',compact('pincode_edit'));
    }

    public function update(Request $request)
    {
        // dd($request);
        
        $updatedata = Pincode::find($request->id);
        // dd( $updatedata);
        $updatedata->city = $request->input('city');
        $updatedata->area = $request->input('area');
        $updatedata->pincode = $request->input('pincode');

        $updatedata->save();

         // Return a JSON response
         return response()->json([
            'success' => true,
            'data' => $updatedata,
            'message' => 'Updated successfully',
        ]);
    }

    public function delete(Request $request)
    {
        // dd($request);
        $deleterecord = Pincode::find($request->id);
        // dd($deleterecord);
        $deleterecord->delete();
        
          return response()->json([
            'success' => true,
            'data' => $deleterecord,
            'message' => 'Deleted successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function pincodechangeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $query = Pincode::where('id',$id)->update(['status'=>$status]);
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
