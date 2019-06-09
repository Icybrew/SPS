<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;

class SpecialistController extends Controller
{

    public function index() {
        return view('specialists.index');
    }

}
