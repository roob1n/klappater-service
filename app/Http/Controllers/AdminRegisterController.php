<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminRegisterController extends Controller {


	public function create() {

		return view('register.create');

	}


	public function store() {

		// Validate the give input
		$this->validate(request(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:admins',
			'password' => 'required|confirmed|min:6'
			]);

		// Create the admin
		$admin = Admin::create([
				'first_name' => request('first_name'),
				'last_name' => request('last_name'),
				'email' => request('email'),
				'password' => bcrypt(request('password'))
			]);

		// Log the created admin in
		auth()->login($admin);

		// Redirect to the dashboard
		return redirect('admin/dashboard');
	}

}


