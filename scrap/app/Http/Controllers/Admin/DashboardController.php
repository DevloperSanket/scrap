<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterdSell;
use App\Models\RegisterdImage;
use App\Models\DirectSell;
use App\Models\Driver;
use App\Models\ScrapCategories;
use App\Models\Directimage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Swift_Image;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {

            // dashboard 
            $directSellPending = DirectSell::where('status', 1)->count();
            $directSellAccepted = DirectSell::where('status', 2)->count();
            $directSellCompleted = DirectSell::where('status', 3)->count();
            $registeredSellPending = RegisterdSell::where('status', 1)->count();
            $registeredSellAccepted = RegisterdSell::where('status', 2)->count();
            $registeredSellCompleted = RegisterdSell::where('status', 3)->count();

            $allregisterUser = User::where('role', 2)->count();

            $activeUser = User::where('status', 1)
                ->where('role', 2)
                ->count();

            $deactiveUser = User::where('status', 0)->where('role', 2)->count();

            return view('admin.dashboard.index', compact(
                'allregisterUser',
                'activeUser',
                'deactiveUser',
                'directSellPending',
                'directSellAccepted',
                'directSellCompleted',
                'registeredSellPending',
                'registeredSellAccepted',
                'registeredSellCompleted'
            ));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function showTable()
    {
        return view('admin.dashboard.show');
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

    public function showdirectselldata()
    {
        return view('admin.dashboard.showdirectsell');
    }


    public function directselldata(Request $request)
    {

        $directselluser = DirectSell::with('scrapCategories', 'Directimage');

        if (!empty($request->get('status'))) {
            $directselluser = $directselluser->where('status', $request->get('status'));
        }

        return DataTables::of($directselluser)


            ->addColumn('status', function ($directselluser) {
                $selectedValue = $directselluser->status;
                $status = '<select class="form-select" onchange="ScrapStatusChange(' . $directselluser->id . ',this.value)">
          <option value="1" ' . ($selectedValue == 1 ? 'selected' : '') . '>Pending</option>
          <option value="2" ' . ($selectedValue == 2 ? 'selected' : '') . '>Accepted</option>
          <option value="3" ' . ($selectedValue == 3 ? 'selected' : '') . '>Completed</option>
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
                } else {
                    $imagesHtml .= '<p>No Images</p>';
                }
                return $imagesHtml;
            })


            ->addColumn('driver', function ($directselluser) {
                $driverSelect = '<select class="form-select" onchange="DriverStatusChange(' . $directselluser->id . ', this.value, this.options[this.selectedIndex].getAttribute(\'data-driver-id\'))">';

                $driverSelect .= '<option selected disabled>Select</option>';

                $drivers = Driver::all();

                foreach ($drivers as $driver) {
                    $selected = $directselluser->driver == $driver->id ? 'selected' : '';

                    $driverSelect .= '<option value="' . $driver->id . '" data-driver-id="' . $driver->id . '" ' . $selected . '>' . $driver->name . '</option>';
                }

                $driverSelect .= '</select>';

                return $driverSelect;
            })


            ->rawColumns(['status', 'category', 'name', 'email', 'number', 'city', 'pincode', 'date', 'time', 'address', 'image', 'driver'])
            ->make(true);

        return view('admin.showdirectsell');
    }


    public function showregisteredselldata()
    {
        return view('admin.dashboard.showregisteredsell');
    }


    public function scrapRecord(Request $request)
    {
        $usersell = RegisterdSell::with('scrapCategories', 'registredImages', 'user')->get();

        if (!empty($request->get('status'))) {
            $usersell = $usersell->where('status', $request->get('status'));
        }
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
                } else {
                    $imagesHtml .= '<p>No Images</p>';
                }
                return $imagesHtml;
            })


            ->addColumn('status', function ($usersell) {
                $selectedValue = $usersell->status;
                $status = '<select class="form-select" onchange="ScrapStatusChange(' . $usersell->id . ',this.value)">
              <option value="1" ' . ($selectedValue == 1 ? 'selected' : '') . ' style="background-color:#dfdfdf;">Pending</option>
              <option value="2" ' . ($selectedValue == 2 ? 'selected' : '') . ' style="background-color:#dfdfdf;">Accepted</option>
              <option value="3" ' . ($selectedValue == 3 ? 'selected' : '') . ' style="background-color:#dfdfdf;">Completed</option>
            </select>';

                return $status;
            })


            ->addColumn('driver', function ($usersell) {
                $driverSelectR = '<select class="form-select" onchange="DriverStatusChange(' . $usersell->id . ', this.value, this.options[this.selectedIndex].getAttribute(\'data-driver-id\'))">';

                $driverSelectR .= '<option style="background-color:#dfdfdf;" selected disabled>Select</option>';

                $drivers = Driver::all();

                foreach ($drivers as $driver) {
                    $selected = $usersell->driver == $driver->id ? 'selected' : '';

                    $driverSelectR .= '<option style="background-color:#dfdfdf;" value="' . $driver->id . '" data-driver-id="' . $driver->id . '" ' . $selected . '>' . $driver->name . '</option>';
                }

                $driverSelectR .= '</select>';

                return $driverSelectR;
            })

            ->addColumn('details', function ($usersell) {
                // Create a link to trigger the modal and pass user details to JavaScript function
                $details = '<a href="#" class="view-image text-center" data-bs-toggle="modal" data-bs-target="#Detailsmodel" onclick="UserDetails(' . htmlspecialchars(json_encode($usersell->user), ENT_QUOTES, 'UTF-8') . ')">View Details</a>';
                return $details;
            })
            
            
            



            ->rawColumns(['status', 'driver', 'category', 'date', 'time', 'image', 'details'])
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


    /// for direct sell status
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


     /////////  driver assign for direct sell
    //  public function directsellDriver(Request $request)
    //  {
    //     //  dd($request);
    //      $id = $request->id;
    //      $driver = $request->driver;
    //      $query = DirectSell::where('id', $id)->update(['driver' => $driver]);
    //      // dd($query);
    //      $driverData = Driver::findOrFail($driver);
    //      $name = DirectSell::where('id', $id)->value('name');
    //      $email = DirectSell::where('id', $id)->value('email');


    //      if ($query) { 
    //         $imagePath = public_path('frontend/theam/assets/images/logo/logo.png');
    //         $imageData = base64_encode(file_get_contents($imagePath));
    //         $imageUrl = 'data:image/png;base64,' . $imageData; 
    //         $imageHeight = 80; 
    //         $imageWidth = 170; 

    //         $title = 'Scrap Take Out Details';
    //         $body = "Hi, $name <br><br> Your Scrap Collecting Request is Approved , 
    //         Our driver will pick the scrap for you. Below are the details of the driver who will pick up the scrap.<br>
    //         Driver Name: $driverData->name <br> Driver Mobile No: $driverData->mobile <br><br> Thank you For Choosing Us !!!<br>
    //         For any query Contact Us at : <br> Mobile no. - 1234567891<br>Email Us at : example@gmail.com<br> Website url : scrap24x7.com <br>
    //         <img src='$imageUrl' height='$imageHeight' width='$imageWidth'>";

    //         Mail::to($email)->send(new WelcomeMail($title,$body));


    //          return response()->json([
    //              'success' => true,
    //              'data' => $query,
    //              'message' => 'Status updated successfully'
    //          ], 200);
    //      } else {
    //          return response()->json(['message' => 'Record not found or driver unchanged'], 404);
    //      }
    //  }


    public function directsellDriver(Request $request)
{
    $id = $request->id;
    $driver = $request->driver;
    $query = DirectSell::where('id', $id)->update(['driver' => $driver]);

    if ($query) {
        $driverData = Driver::findOrFail($driver);
        $name = DirectSell::where('id', $id)->value('name');
        $email = DirectSell::where('id', $id)->value('email');

        $imageUrl = asset('frontend/theam/assets/images/logo/logo.png');
        $imageHeight = 80;
        $imageWidth = 170;

        // Construct the email body with embedded image
        $title = 'Scrap Take Out Details';
        $body = "<html>
                    <body>
                        <p>Hi, $name,</p>
                        <p>Your Scrap Collecting Request is Approved. Our driver will pick the scrap for you.</p>
                        <p>Below are the details of the driver who will pick up the scrap:</p>
                        <p>Driver Name: $driverData->name</p>
                        <p>Driver Mobile No: $driverData->mobile</p>
                        <p>Thank you for choosing us!</p>
                        <p>For any queries, contact us at:</p>
                        <ul>
                            <li>Mobile no. - 1234567891</li>
                            <li>Email us at: example@gmail.com</li>
                            <li>Website URL: scrap24x7.com</li>
                        </ul>
                        <img src='$imageUrl' alt='Logo' height='$imageHeight' width='$imageWidth'>
                    </body>
                </html>";

        // Send email
        Mail::to($email)->send(new WelcomeMail($title, $body));

        return response()->json([
            'success' => true,
            'data' => $query,
            'message' => 'Status updated successfully'
        ], 200);
    } else {
        return response()->json(['message' => 'Record not found or driver unchanged'], 404);
    }
}



    /// for registered status
    public function registeredsellStatus(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $status = $request->status;
        $query = RegisterdSell::where('id', $id)->update(['status' => $status]);
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


     /// driver status for registered sell
     public function registeredsellDriver(Request $request)
     {
         $id = $request->id;
         $driver = $request->driver;
         $query = RegisterdSell::where('id', $id)->update(['driver' => $driver]);

         // get driver data
         $driverData = Driver::findOrFail($driver);
        // Retrieve the registered sell data along with the related user data
         $registerdSellUserData = RegisterdSell::with('user')->findOrFail($id);
         // Access user data related to the registered sell
         $userName = $registerdSellUserData->user->name;
         $userEmail = $registerdSellUserData->user->email;


         $emaildata = new Request([
            'email' => $userEmail,
            'name' => $userName,
            'driver_name' => $driverData->name,
            'driver_mobile' => $driverData->mobile,
            ]);


         if ($query) {

            // $imagePath = public_path('frontend/theam/assets/images/logo/logo.png');
            // $imageData = base64_encode(file_get_contents($imagePath));
            // $imageUrl = 'data:image/png;base64,' . $imageData; 
            // $imageHeight = 80; 
            // $imageWidth = 170; 

            // $title = 'Scrap Take Out Details';
            // $body = "Hi, $userName <br><br> Your Scrap Collecting Request is Approved , 
            // Our driver will pick the scrap for you. Below are the details of the driver who will pick up the scrap.<br>
            // Driver Name: $driverData->name <br> Driver Mobile No: $driverData->mobile <br><br> Thank you For Choosing Us !!!<br>
            // For any query Contact Us at : <br> Mobile no. - 1234567891<br>Email Us at : example@gmail.com<br> Website url : scrap24x7.com <br>
            // <img src='$imageUrl' height='$imageHeight' width='$imageWidth'>";

            Mail::to($userEmail)->send(new WelcomeMail($emaildata));



             return response()->json([
                 'success' => true,
                 'data' => $query,
                 'message' => 'Status updated successfully'
             ], 200);
         } else {
             return response()->json(['message' => 'Record not found or driver unchanged'], 404);
         }
     }


}
