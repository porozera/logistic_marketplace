<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index_user() {
        return view('pages.admin.laporan.user');
    }
    public function index_shipment() {
        return view('pages.admin.laporan.shipment');
    }
}
