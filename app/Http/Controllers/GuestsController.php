<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class GuestsController extends Controller
{
    
	public function __construct() {
		$this->middleware('auth');
	}

    public function index($id) {

    	$event = Event::find($id);

    	return view('admin.guests.index', compact('event'));
    }
}
