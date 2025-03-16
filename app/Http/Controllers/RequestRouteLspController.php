<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestRoute;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequestRouteLspController extends Controller
{
    public function index()
    {
        $requests = RequestRoute::all();
        return view('pages.lsp.request_routes.index', compact('requests'));
    }

    public function show($id)
    {
    $request = RequestRoute::findOrFail($id);

    return view('pages.lsp.request_routes.detail', compact('request'));
    }
}
