<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function inicio() {
        return view('web.home');
    }

    public function prueba1() {
        return view('web.prueba1');
    }
}
