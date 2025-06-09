<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Container;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $containers = Container::all();
        return view('pages.customer.calculator.index', compact('categories','containers'));
    }
}
