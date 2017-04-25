<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }


    public function index()
    {

        return view('admin.location.index')->with('location', auth()->user()->location);
    }


    public function create()
    {
        if(auth()->user()->location_id) {
            return redirect('admin/location/edit');
        }

        return view('admin.location.create');
    }


    public function store(){

        $this->validate(request(), [
                'name' => 'required',
                'spotify_account_id' => 'required'
            ]);

        $location = Location::create(request(['name', 'spotify_account_id']));

        auth()->user()->location()->associate($location);

        auth()->user()->save();

        return redirect('/admin/location');
    }

    

    public function edit()
    {
        return view('admin.location.edit')->with('location', auth()->user()->location);
    }


    public function update()
    {
         $this->validate(request(), [
                'name' => 'required',
                'spotify_account_id' => 'required'
            ]);


        auth()->user()->location()->update(request(['name', 'spotify_account_id']));

        return redirect('/admin/location');
    }
}
