<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ShipmentReportController extends Controller
{
    public function index() {
        $shipments = Order::select('id', 'noOffer', 'lspName', 'origin', 'destination', 'loadingDate', 'shippingDate', 'shipmentType', 'status', 'paymentStatus')->get();

        return view('pages.admin.shipments.shipment', compact('shipments'));
    }

    public function show($id) {
        $shipment = Order::findOrFail($id);
        return view('pages.admin.shipments.shipment-detail', compact('shipment'));
}

}
