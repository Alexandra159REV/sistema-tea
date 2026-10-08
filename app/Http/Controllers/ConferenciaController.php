<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConferenciaController extends Controller
{
    public function index()
    {
        return view('conferencia');
    }
}
