<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScrapCategories;
use Illuminate\Validation\Rule;
use DataTables;


class ScrapcategoryController extends Controller
{
   
    public function index()
    {
        return view('admin.scrap-category.index');
    }

  
    public function create()
    {
        return view('admin.scrap-category.form');
    }

    public function scrapdata()
    {
        $query = ScrapCategories::query();

        return Datatables::of($query)
            ->addColumn('name', function ($query) {
                return $query->name;
            })
            
            ->addColumn('action', function ($query) {
                $editButton = '<a href="' . route('scrapcategory.edit', $query->id) . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>';
                $deleteButton = '<a class="delete btn btn-danger btn-sm" onclick="deletefunction(' . $query->id .')"><i class="bi bi-trash3"></i></a>';
            
                return $editButton . ' ' . $deleteButton;
            })
            
            ->addColumn('status', function ($query) {
                $status = '<div class="form-check form-switch">
               <input class="form-check-input text-center" type="checkbox" ' . ($query->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $query->id . '" onchange="ScrapStatusChange(' . $query->id . ')">
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
            'name' => ['required', Rule::unique('scrap_categories')],
        ];

        // Custom error messages
        $messages = [
            'name.required' => 'Name is required',
            'name.unique' => 'This name is already used',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        // Create a new ScrapCategories instance
        $scrapCategory = new ScrapCategories;
        

        $data = ScrapCategories::create([
            'name' => $validatedData['name'],
            'status' => '1',
        ]);

        

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Category created successfully',
        ]);
    }

   
    
    public function edit(string $id)
    {

        $category_edit = ScrapCategories::find($id);
        return view('admin.scrap-category.edit',compact('category_edit'));
    }

    public function update(Request $request)
    {
        
        $updatedata = ScrapCategories::find($request->id);
        $updatedata->name = $request->input('name');
        $updatedata->save();

         // Return a JSON response
         return response()->json([
            'success' => true,
            'data' => $updatedata,
            'message' => 'Category Updated successfully',
        ]);
    }

    
    public function delete(Request $request)
    {
        $deleterecord = ScrapCategories::find($request->id);
        $deleterecord->delete();
        
          return response()->json([
            'success' => true,
            'data' => $deleterecord,
            'message' => 'Category Deleted successfully',
        ]);
    }

    // for status value change of scrap
    public function scrapchangeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $query = ScrapCategories::where('id',$id)->update(['status'=>$status]);
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
