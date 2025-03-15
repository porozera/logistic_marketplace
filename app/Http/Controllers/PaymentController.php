<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Service;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $offer = offersModel::find($id);
        $services = Service::all();
        return view('pages.customer.payments.index', compact('offer','services'));
    }
}
