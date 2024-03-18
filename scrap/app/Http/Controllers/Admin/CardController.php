<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScrapCategories;
use App\Models\Card;

use DataTables;

class CardController extends Controller
{
    public function index()
    {

        return view('admin.card.index');
    }

    public function create()
    {

        $category_id = ScrapCategories::where('status', 1)->get();
        // dd($category_id);
        return view('admin.card.form',  compact('category_id'));
    }

    public function carddata()
    {

        $query = Card::with('scrapCategories')->get();

        // dd($query);
        return Datatables::of($query)
            ->addColumn('category_id', function ($query) {
                return $query->ScrapCategories->name;
            })

            ->addColumn('price', function ($query) {
                return $query->price;
            })

            ->addColumn('image', function ($query) {
                return $query->image;
            })

            ->addColumn('action', function ($query) {
                $editButton = '<a href="' . route('card.edit', $query->id) . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>';
                $deleteButton = '<a class="delete btn btn-danger btn-sm" onclick="deletefunction(' . $query->id . ')"><i class="bi bi-trash3"></i></a>';

                return $editButton . ' ' . $deleteButton;
            })

            ->addColumn('status', function ($query) {
                $status = '<div class="form-check form-switch">
           <input class="form-check-input text-center" type="checkbox" ' . ($query->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $query->id . '" onchange="cardStatusChange(' . $query->id . ')">
        </div>';
                return $status;
            })


            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'categoryName' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required',
        ];

        $messages = [
            'categoryName.required' => 'Category Name is required',
            'image.required' => 'Image is required',
            'price.required' => 'Price is required',
        ];
        $validatedData = $request->validate($rules, $messages);
        if ($image = $request->file('image')){
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('card', $imageName, 'public');
            $imagePath = 'storage/' . $imagePath;
        }
        
        $data = Card::create([
            'category_id' => $validatedData['categoryName'],
            'price' => $validatedData['price'],
            'image' => $imagePath,
        ]);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Form Submitted successfully',
        ]);
    }

    public function edit(string $id)
    {

        $category = ScrapCategories::get();
        $card_edit = Card::find($id);
        // dd($card_edit);
        return view('admin.card.edit', compact('card_edit', 'category'));
    }

    public function update(Request $request)
    {
        $rules = [
            'categoryName' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required',
        ];

        $messages = [
            'categoryName.required' => 'Category Name is required',
            'image.required' => 'Image is required',
            'price.required' => 'Price is required',
        ];

        $validatedData = $request->validate($rules, $messages);

        $updatedata = Card::findOrFail($request->id);
        $updatedata->fill($request->only(['category_id', 'price']));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('card', $imageName);
            $updatedata->image = $imagePath;
        }

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
        $deleterecord = Card::find($request->id);
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
    public function cardchangeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $query = Card::where('id', $id)->update(['status' => $status]);
        if ($query) {
            return response()->json([
                'success' => true,
                'data' => $query,
                'message' => 'Status updated successfully'
            ], 200);
        } else {
            return response()->json(['message' => 'Record not found or status unchanged'], 404);
        }
    }
}
