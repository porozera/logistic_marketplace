<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestRouteController extends Controller
{
    public function index()
    {
        return view('pages.request_routes.index');
    }
}
