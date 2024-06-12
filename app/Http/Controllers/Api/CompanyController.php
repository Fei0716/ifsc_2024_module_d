<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyOrdersResource;
use App\Models\Company;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $company = Company::where('api_key', $request->api_key)->first();
        $orders = Order::where([
            'company_id' => $company->id,
        ])->get();
        return response()->json([

            'orders' => CompanyOrdersResource::collection($orders),
        ], 200);
    }

    public function show(Request $request, Order $order)
    {
        $company = Company::where('api_key', $request->api_key)->first();
        if ($order->company_id != $company->id) {
            return response()->json([
                'message' => 'This is not your order',
            ], 401);
        }
        return response()->json([
            'orders' => new CompanyOrdersResource($order),
        ], 200);
    }
}
