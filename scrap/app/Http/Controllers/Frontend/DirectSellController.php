<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectSell;
use Illuminate\Validation\Rule;
use DataTables;

class DirectSellController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }

    public function create(){
        return view('frontend.sell-scrap');
    }

    public function directselldata()
    {

        $query = DirectSell::query();

        // dd($query);
        return Datatables::of($query)
            ->addColumn('name', function ($query) {
                return $query->ScrapCategories->name;
            })

            ->addColumn('email', function ($query) {
                return $query->email;
            })

            ->addColumn('number', function ($query) {
                return $query->number;
            })

            ->addColumn('city', function ($query) {
                return $query->ScrapCategories->city;
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
                return $query->ScrapCategories->time;
            })

            ->addColumn('image', function ($query) {
                return $query->image;
            })

            ->addColumn('address', function ($query) {
                return $query->address;
            }) 

            ->addColumn('status', function ($query) {
                $status = '<div class="form-check form-switch">
           <input class="form-check-input text-center" type="checkbox" ' . ($query->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $query->id . '" onchange="cardStatusChange(' . $query->id . ')">
        </div>';
                return $status;
            })


            ->rawColumns(['name','email','number','city','pincode','scraptype','date','time','image','address','status'])
            ->make(true);
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required',
            'email'=>'required',
            'number' => 'required',
            'city'=>'required',
            'pincode' => 'required',
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
            'pincode.required' => 'Pincode is required',
            'scraptype.required' => 'Scrap Type is required',
            'date.required' => 'Date is required',
            'time.required' => 'Time is required',
            'address.required' => 'Address is required',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        if ($image = $request->file('image')){
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('DirectSell', $imageName, 'public');
            $imagePath = 'storage/' . $imagePath;
        }


        $data = DirectSell::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'number' => $validatedData['number'],
            'city' => $validatedData['city'],
            'pincode' => $validatedData['pincode'],
            'scraptype' => $validatedData['scraptype'],
            'time' => $validatedData['time'],
            'date' => $validatedData['date'],
            'image' => $imagePath,
            'address'=>$validatedData['address'],

            'status' => '1',
        ]);

        

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'created successfully',
        ]);
    }

}
