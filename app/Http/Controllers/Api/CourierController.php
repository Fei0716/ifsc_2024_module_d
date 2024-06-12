<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CourierController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $courier = Courier::where('username', $validated['username'])->first();
        if ($courier && Hash::check($validated['password'], $courier->password)) {
            $token = $courier->createToken($courier->username, ['*'], now()->addHour(8));
            return response()->json([
                'message' => 'Login successful',
                'token' => $token->plainTextToken,
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }

    public function sendLiveLocation(Request $request)
    {
        $validated = $request->validate([
            'live_latitude' => 'required|numeric',
            'live_longitude' => 'required|numeric',
        ]);
        $courier = Courier::find($request->user()->id);
        $courier->live_latitude = $validated['live_latitude'];
        $courier->live_longitude = $validated['live_longitude'];
        $courier->save();

        return response()->json([
            'message' => 'Live location updated',
        ], 200);
    }

    public function getLiveLocation(Request $request, Courier $courier)
    {
        return response()->json([
            'live_latitude' => $courier->live_latitude,
            'live_longitude' => $courier->live_longitude,
        ], 200);
    }
}
