<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectSell;
use App\Models\ScrapCategories;
use App\Models\Directimage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {

            $directsell = DirectSell::get()->count();
            // dd($directsell);

            $allregisterUser = User::where('role', 2)->count();
            // dd($allregisterUser);

            $activeUser = User::where('status', 1)
                ->where('role', 2)
                ->count();

            $deactiveUser = User::where('status', 0)->where('role', 2)->count();

            return view('admin.dashboard.index', compact('allregisterUser', 'activeUser', 'deactiveUser','directsell'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function showTable()
    {
        return view('admin.dashboard.show');
    }

    public function showdirectselldata()
    {
        return view('admin.dashboard.showdirectsell');
    }

    public function data()
    {
        $users = User::where('role', 2)->get();
        return DataTables::of($users)
            ->addColumn('unique_id', function ($users) {
                return $users->unique_id;
            })
            ->addColumn('name', function ($users) {
                return $users->name;
            })
            ->addColumn('email', function ($users) {
                return $users->email;
            })
            ->addColumn('mobile', function ($users) {
                return $users->mobile;
            })
            ->addColumn('city', function ($users) {
                return $users->city;
            })
            ->addColumn('pincode', function ($users) {
                return $users->pincode;
            })
            ->addColumn('address', function ($users) {
                return $users->address;
            })
            ->addColumn('status', function ($users) {
                $status = '<div class="form-check form-switch">
           <input class="form-check-input text-center" type="checkbox" ' . ($users->status == 1 ? 'checked' : '') . ' role="switch" data-id="' . $users->id . '" onchange="ScrapStatusChange(' . $users->id . ')">
        </div>';
                return $status;
            })
            ->rawColumns(['action', 'status', 'unique_id', 'name', 'email', 'mobile', 'city', 'pincode', 'address'])
            ->make(true);
    }



    public function directselldata()
    {
        $directselluser = DirectSell::with('scrapCategories','Directimage');
        return DataTables::of($directselluser)

        ->addColumn('status', function ($directselluser)  {
            $selectedValue = $directselluser->status;
          $status = '<select class="form-select" onchange="ScrapStatusChange('.$directselluser->id.',this.value)">
          <option value="1" '. ($selectedValue == 1 ? 'selected' : '') .'>Pending</option>
          <option value="2" '. ($selectedValue == 2 ? 'selected' : '') .'>Inprocess</option>
          <option value="3" '. ($selectedValue == 3 ? 'selected' : '') .'>Complited</option>
        </select>';

          return $status;
        })

            ->addColumn('category', function ($directselluser) {
                return $directselluser->ScrapCategories->name;
            })
            ->addColumn('name', function ($directselluser) {
                return $directselluser->name;
            })
            ->addColumn('email', function ($directselluser) {
                return $directselluser->email;
            })
            ->addColumn('number', function ($directselluser) {
                return $directselluser->number;
            })
            ->addColumn('city', function ($directselluser) {
                return $directselluser->city;
            })
            ->addColumn('pincode', function ($directselluser) {
                return $directselluser->pincode;
            })
            ->addColumn('scraptype', function ($directselluser){
                return $directselluser->scraptype;
            })
            ->addColumn('date', function ($directselluser) {
                return $directselluser->date;
            })
            ->addColumn('time', function ($directselluser) {
                return $directselluser->time;
            })
            ->addColumn('address', function ($directselluser) {
                return $directselluser->address;
            })
            ->addColumn('image', function ($directselluser) {
                $imagesHtml = '';
                if ($directselluser->Directimage->isNotEmpty()) {
                    foreach ($directselluser->Directimage as $image) {
                        $imageUrl = $image->url;
                        $imagesHtml .= '<a href="#" class="view-image text-center" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showData(\'' . $imageUrl . '\')">View</a>';
                    }
                }else{
                    $imagesHtml .= '<p>No Images</p>';
                }
                return $imagesHtml;
            })
            ->rawColumns([ 'status','category','name', 'email', 'number', 'city', 'pincode','date','time', 'address','image'])
            ->make(true);
    }

    public function changeUserStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $query = User::where('id', $id)->update(['status' => $status]);
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


    /// for direct sell 
    public function directsellStatus(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $status = $request->status;
        $query = DirectSell::where('id', $id)->update(['status' => $status]);
        // dd($query);
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
