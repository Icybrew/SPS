<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index() {
        return view('contacts.index');
    }

}
