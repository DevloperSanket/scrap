<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScrapCategories;
use App\Models\RegisterdSell;
use App\Models\RegistredImage;
use DataTables;

class SellScrapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('UserAdmin.Sell.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ScrapCategories::get();
        // dd($categories);
        return view('UserAdmin.sell.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'date' => 'required',
            'time' => 'required',
            'category' => 'required',
        ];

        $messages = [
            'date.required' => 'Please select a date for colecting scrap',
            'time.required' => 'Please select a time for colecting scrap',
            'category.required' => 'Please select category',
        ];
        $validatedData = $request->validate($rules, $messages);

        $scrap = RegisterdSell::create([
            'date' => $validatedData['date'],
            'time' => $validatedData['time'],
            'category' => $validatedData['category'],
        ]);

        if ($request->hasFile('images')) {
            // dd($request->file('images'));
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalName();
                $image->storeAs('Registerd', $imageName, 'public');
                // dd($imageName);
                RegistredImage::create([
                    'registerd_sells_id' => $scrap->id,
                    'url' => 'storage/Registerd/' . $imageName
                ]);
            }
        }

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $scrap,
            'message' => 'Form Submitted successfully',
        ]);
    }

    public function scrapRecord()
    {
        $usersell = RegisterdSell::with('scrapCategories', 'registredImages')->get();


        // dd($usersell);
        return DataTables::of($usersell)
            ->addColumn('category', function ($usersell) {
                return $usersell->ScrapCategories->name;
            })

            ->addColumn('date', function ($usersell) {
                return $usersell->date;
            })
            ->addColumn('time', function ($usersell) {
                return $usersell->time;
            })
            ->addColumn('image', function ($usersell) {
                $imagesHtml = '';
                if ($usersell->registredImages->isNotEmpty()) {
                    foreach ($usersell->registredImages as $image) {
                        $imageUrl = $image->url;
                        $imagesHtml .= '<a href="#" class="view-image text-center" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showData(\'' . $imageUrl . '\')">View</a>';
                    }
                }else{
                    $imagesHtml .= '<p>No Images</p>';
                }
                return $imagesHtml;
            })

            ->addColumn('action', function ($usersell) {
                $editButton = '<a href="' . route('card.edit', $usersell->id) . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>';
                $deleteButton = '<a class="delete btn btn-danger btn-sm" onclick="deletefunction(' . $usersell->id . ')"><i class="bi bi-trash3"></i></a>';
                return $editButton . ' ' . $deleteButton;
            })

            ->addColumn('status', function ($usersell) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input text-center" type="checkbox" ' . ($usersell->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $usersell->id . '" onchange="cardStatusChange(' . $usersell->id . ')">
                </div>';
                return $status;
            })
            ->rawColumns(['action', 'status', 'category', 'date', 'time', 'image'])
            ->make(true);
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
