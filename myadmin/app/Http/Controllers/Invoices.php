<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Invoices extends Controller
{
    public function index(){
        return view('pages/invoices');
    }
}
