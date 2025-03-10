<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index_customer()
    {
        return view('welcome');
    }

    public function index_admin()
    {
        return view('landing-page');
    }
}
