<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectSell;
use App\Models\Directimage;
use App\Models\Pincode;
use App\Models\ScrapCategories;
use Illuminate\Validation\Rule;
use DataTables;

class SellController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $scrapcategory = ScrapCategories::get();
        return view( 'frontend.sell-scrap',compact('scrapcategory'));
    }

   public function directselldata()
    {

        $query = DirectSell::query();

        // dd($query);
        return Datatables::of($query)
            ->addColumn('name', function ($query) {
                return $query->name;
            })

            ->addColumn('email', function ($query) {
                return $query->email;
            })

            ->addColumn('number', function ($query) {
                return $query->number;
            })

            ->addColumn('city', function ($query) {
                return $query->city;
            })

            ->addColumn('pincode', function ($query) {
                return $query->pincode;
            })

            ->addColumn('scraptype', function ($query) {
                return $query->scraptype;
            })

            ->addColumn('date', function ($query) {
                return $query->date;
            })

            ->addColumn('time', function ($query) {
                return $query->time;
            })

            ->addColumn('image', function ($query) {
                return $query->image;
            })

            ->addColumn('address', function ($query) {
                return $query->address;
            }) 

            ->rawColumns(['name','email','number','city','pincode','scraptype','date','time','image','address'])
            ->make(true);
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        // Validation rules
        $rules = [
            'name' => 'required',
            'email'=>'required',
            'number' => 'required',
            'city'=>'required',
            'pincode' => 'required|digits:6|exists:pincodes,pincode',
            'scraptype'=>'required',
            'date' => 'required',
            'time'=>'required',
            'address'=>'required',
        ];

        // Custom error messages
        $messages = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'number.required' => 'Number is required',
            'city.required' => 'City is required',
            'pincode.required' => 'Pincode is invalid',
            'scraptype.required' => 'Scrap Type is required',
            'date.required' => 'Date is required',
            'time.required' => 'Time is required',
            'address.required' => 'Address is required',
        ];

        // Validate the request data
        $validatedData = $request->validate( $rules, $messages );

        $data = DirectSell::create( [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'number' => $validatedData['number'],
            'city' => $validatedData['city'],
            'pincode' => $validatedData['pincode'],
            'category' => $validatedData['scraptype'],
            'time' => $validatedData['time'],
            'date' => $validatedData['date'],
            'address'=>$validatedData['address'],
        ] );

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalName();
                $image->storeAs('Directsell', $imageName, 'public');
                Directimage::create([
                    'direct_sells_id' => $data->id,
                    'url' => 'storage/Directsell/' . $imageName
                ]);
            }
        }

        return response()->json( [
            'success' => true,
            'data' => $data,
            'message' => 'Submitted Successfully',
        ] );

    }

  
}
