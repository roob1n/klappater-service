<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\ActivationCode as Code;
use App\Guest;
use Carbon\Carbon;

class CodesController extends Controller {
    public function __construct() {
        $this->middleware('auth', ['except' => 'show']);
    }


    public function index(Event $event) {

        return view('admin.codes.index', compact('event'));
    }

    public function create(Event $event) {

        return view('admin.codes.create', compact('event'));
    }

    public function store(Event $event) {

        $this->validate(request(), [
            'num_of_codes' => 'required|min:1|max:100',
        ]);

        $event->addActivationCodes(request('num_of_codes'));

        return redirect('/admin/events/' . $event->id . '/codes');
    }

    public function show(Event $event) {

        $code = Code::where('event_id', $event->id)->valid()->first();

    	return view('codes.show', compact('code', 'event'));
    }
}
