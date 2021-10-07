<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $value = 'Hello World';
        if ($value == 'tes')
        {

        }
        return view('home');
    }
}
