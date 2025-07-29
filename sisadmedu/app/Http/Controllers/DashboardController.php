<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Controlador para el Dashboard
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
