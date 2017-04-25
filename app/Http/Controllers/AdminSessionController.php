<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSessionController extends Controller
{

	public function __construct() {

		$this->middleware('guest', ['except' => 'destroy']);
	}
    
    public function create() {
    	return view('session.create');
    }

    public function store() {

    	if( ! auth()->attempt(request(['email', 'password']))) {
    		return redirect()->back()->withErrors([
    			'message' => 'Bitte überprüf deine Anmeldedaten.']);
    	} 

    	return redirect('admin/dashboard');
    }

    public function destroy() {

    	auth()->logout();

    	return redirect('/');
    }
}
