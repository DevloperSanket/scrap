<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function about()
    {
        return view('frontend.about');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function sell(){
        return view('frontend.sell-scrap');
    }

    public function allscrap(){
        return view('frontend.all-scrap');
    }

    public function ElectronicScrap(){
        return view('frontend.electronic-scrap');
    }

    public function appliances(){
        return view('frontend.appliances');
    }

    public function furniture(){
        return view('frontend.furniture');
    }

    public function itscrap(){
        return view('frontend.itscrap');
    }

    public function collage(){
        return view('frontend.collage');
    }

    public function bankscrap(){
        return view('frontend.bank-scrap');
    }

    public function gov(){
        return view('frontend.gov');
    }

    public function Ironscrap(){
        return view('frontend.iron');
    }

    public function savegreen(){
        return view('frontend.save-green');
    }

    public function service(){
        return view('frontend.service');
    }

}
