<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lógica para a página inicial
        return view('home'); // Retorna a view 'welcome' para a página inicial
    }
}
