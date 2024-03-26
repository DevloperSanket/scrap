<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScrapCategories;
use App\Models\RegisterdSell;
use App\Models\Driver;
use App\Models\RegistredImage;
use Illuminate\Support\Facades\Auth;
use DataTables;

class SellScrapController extends Controller
{

    public function index()
    {
        return view('UserAdmin.sell.index');
    }


    public function create()
    {
        $categories = ScrapCategories::get();
        // dd($categories);
        return view('UserAdmin.sell.form', compact('categories'));
    }

    public function store(Request $request)
    {
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
            'user_id' => $validatedData['user_id'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalName();
                $image->storeAs('Registerd', $imageName, 'public');
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
        $usersell = RegisterdSell::with('scrapcategories', 'registredImages', 'driver')->get();

       

        return DataTables::of($usersell)
            ->addColumn('category', function ($usersell) {
                return $usersell->scrapcategories->name ?? 'No Category';
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
                } else {
                    $imagesHtml .= '<p>No Images</p>';
                }
                return $imagesHtml;
            })

            ->addColumn('status', function ($usersell) {
                $status = $usersell->status == '1' ? 'Pending' : ($usersell->status == '2' ? 'In process' : ($usersell->status == '3' ? 'Completed' : 'No Update'));
                return $status;
            })

            ->addColumn('action', function ($usersell) {
                $editButton = '<a href="' . route('scrap.edit', $usersell->id) . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>';
                $deleteButton = '<a class="delete btn btn-danger btn-sm" onclick="deletefunction(' . $usersell->id . ')"><i class="bi bi-trash3"></i></a>';

                if ($usersell->status != '1') {
                    $editButton = '<button class="edit btn btn-warning btn-sm" disabled><i class="bi bi-pencil-fill"></i></button>';
                    $deleteButton = '<button class="delete btn btn-danger btn-sm" disabled><i class="bi bi-trash3"></i></button>';
                }

                return $editButton . ' ' . $deleteButton;
            })

            ->addColumn('driver', function ($usersell) {
                return $usersell->Driver->name ?? 'No Driver';
            })
          

            ->rawColumns(['action', 'status', 'category', 'date', 'time', 'image', 'driver'])
            ->make(true);
    }


    public function edit(string $id)
    {
        $registered_edit = RegisterdSell::with('registredimages')->findOrFail($id);
        if (!$registered_edit) {
            return abort(404, 'Registered sell not found');
        }

        $categories = ScrapCategories::get();
        return view('UserAdmin.sell.edit', compact('registered_edit', 'categories'));
    }



    public function update(Request $request)
    {
        $rules = [
            'date' => 'required',
            'time' => 'required',
            'category' => 'required',
        ];

        $messages = [
            'date.required' => 'Please select a date for collecting scrap',
            'time.required' => 'Please select a time for collecting scrap',
            'category.required' => 'Please select category',
        ];

        $validatedData = $request->validate($rules, $messages);

        $updatedData = RegisterdSell::findOrFail($request->sellid);

        $updatedData->date = $validatedData['date'];
        $updatedData->time = $validatedData['time'];
        $updatedData->category = $validatedData['category'];

        if ($request->hasFile('images')) {

            $updatedData->registredimages()->delete();

            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalName();
                $image->storeAs('Registerd', $imageName, 'public');
                $registeredImage = new RegistredImage;
                $registeredImage->registerd_sells_id = $updatedData->id;
                $registeredImage->url = 'storage/Registerd/' . $imageName;
                $registeredImage->save();
            }
        }

        $updatedData->save();

        return response()->json([
            'success' => true,
            'data' => $updatedData,
            'message' => 'Updated successfully',
        ]);
    }




    public function delete(Request $request)
    {
        //  dd($request);
        $deleterecord = RegisterdSell::find($request->id);
        //  dd($deleterecord);
        $deleterecord->delete();

        return response()->json([
            'success' => true,
            'data' => $deleterecord,
            'message' => 'Deleted successfully',
        ]);
    }
}
