<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function nose(){
        return "hola perros asd";
    }
    
    public function listar(){
        return view('inventario/listar');
    }
}