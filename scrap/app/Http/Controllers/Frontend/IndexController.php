<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ScrapCategories;
use Illuminate\Http\Request;
use App\Models\Card;

class IndexController extends Controller
{
    
    public function index()
    {
        return view('welcome');
    }

   
    public function about()
    {
        return view('frontend.about');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function sell(){

        $scrapcategory = ScrapCategories::get();
        return view('frontend.sell-scrap',compact('scrapcategory'));
    }

    public function allscrap(){
        $cards = Card::with('scrapCategories')->get();
        return view('frontend.all-scrap',compact('cards'));
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

    public function papar(){
        return view('frontend.papar');
    }

    public function plastic(){
        return view('frontend.plastic');
    }

    public function steel(){
        return view('frontend.steel');
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
