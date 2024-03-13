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

    public function doortodoor(){
        return view('frontend.doortodoor');
    }

    public function packaging(){
        return view('frontend.packaging');
    }

    public function cunstruction(){
        return view('frontend.cunstruction');
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

    public function socity(){
        return view('frontend.socity');
    }

    public function savegreen(){
        return view('frontend.save-green');
    }

    public function service(){
        return view('frontend.service');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
