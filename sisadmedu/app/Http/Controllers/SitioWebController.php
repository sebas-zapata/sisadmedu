<?php

namespace App\Http\Controllers;

class SitioWebController extends Controller
{
    // Método para mostrar la página principal del sitio web
    // Este método retorna la vista 'sitio_web.index'
    // que contiene el contenido principal del sitio web
    public function index()
    {
        return view('sitioweb.inicio');
    }
}
