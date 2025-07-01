<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ShipmentReportController extends Controller
{
    public function index() {
    $shipments = Order::with('lsp') // eager load user
        ->select(
            'id',
            'lsp_id', // dibutuhkan agar bisa relasi ke user
            'noOffer',
            'origin',
            'destination',
            'shipmentType',
            'deliveryDate',
            'arrivalDate',
            'status',
            'paymentStatus'
        )->get();

    return view('pages.admin.shipments.shipment', compact('shipments'));
}

    public function show($id) {
        $shipment = Order::findOrFail($id);
        return view('pages.admin.shipments.shipment-detail', compact('shipment'));
}

}
