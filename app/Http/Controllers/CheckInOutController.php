<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckInOutController extends Controller
{
    public function index() {
        return view('check-in-out');
    }
}
