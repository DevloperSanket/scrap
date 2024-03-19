<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScrapCategories;
use App\Models\RegisterdSell;
use App\Models\RegistredImage;
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
        return view('UserAdmin.sell.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'date'=> 'required',
            'time'=> 'required',
            'category'=>'required',
        ];

        $messages = [
            'date.required'=> 'Please select a date for colecting scrap',
            'time.required'=> 'Please select a time for colecting scrap',
            'category.required'=> 'Please select category',
        ];
        $validatedData = $request->validate($rules, $messages);

        $scrap = RegisterdSell::create([
            'date'=> $validatedData['date'],
            'time'=> $validatedData['time'],
            'category' => $validatedData['category'],
        ]);

        
        if($request->hasFile('images')){
            // dd($request->file('images'));
            foreach ($request->file('images') as $image) {
                $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalName();
                $image->storeAs('Registerd',$imageName,'public');
                // dd($imageName);
                RegistredImage::create([
                    'registerd_sells_id'=>$scrap->id,
                    'url'=> 'storage/Registerd'. $imageName
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
