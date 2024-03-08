<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScrapCategories;
use Illuminate\Validation\Rule;
use DataTables;


class ScrapcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.scrap-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.scrap-category.form');
    }

    public function data()
    {
        $data = ScrapCategories::query();

        return DataTables::of($data)
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" class="edit btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                $status = '<div class="form-check form-switch">
               <input class="form-check-input" type="checkbox" ' . ($row->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $row->id . '" onchange="statusChange(' . $row->id . ')">
            </div>';
                return $status;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $data = ScrapCategories::create([
            'name' => $validatedData['name'],
        ]);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Category created successfully',
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
        //
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
    public function destroy(string $id)
    {
        //
    }
}
