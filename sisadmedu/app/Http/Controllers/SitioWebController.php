<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitioWebController extends Controller
{
    public function index()
    {
        return view('sitio_web.index');
    }
}
