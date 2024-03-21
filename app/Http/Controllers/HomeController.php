<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('template.sejarah');
    }
    public function sejarah(){
        return view('template.home ');
    }
}
