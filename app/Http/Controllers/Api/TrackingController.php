<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracking;
use Illuminate\Support\Facades\Validator;

class TrackingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'        => 'required|exists:orders,id',
            'currentLocation' => 'required|string|max:255',
            'currentVehicle'  => 'nullable|string|max:255',
            'status'          => 'required|string|max:50',
            'description'     => 'nullable|string',
            'longitude'       => 'required|numeric|between:-180,180',
            'latitude'        => 'required|numeric|between:-90,90',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $tracking = Tracking::create($request->only([
            'order_id',
            'currentLocation',
            'currentVehicle',
            'status',
            'description',
            'longitude',
            'latitude',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Tracking data created successfully.',
            'data'    => $tracking,
        ], 201);
    }
}
