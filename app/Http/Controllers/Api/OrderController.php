<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Courier;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\WebhookService;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where([
            'courier_id' => null,
            'status' => 'pending',
        ])->join('companies', 'orders.company_id', 'companies.id')
            ->select('orders.id', "start_latitude",
                "start_longitude",
                "delivery_address",
                "delivery_provider_name",
                "delivery_provider_mobile",
                "destination_latitude",
                "destination_longitude",
                "destination_address",
                "recipient_name",
                "recipient_mobile",
                "companies.name as company_name",
                "orders.created_at")
            ->get();

        return response()->json([
            'orders' => $orders,
        ], 500);
    }

    public function acceptPackage(Request $request, Order $order)
    {
        $validated = $request->validate([
            'live_latitude' => 'required|numeric',
            'live_longitude' => 'required|numeric',
        ]);
        if ($order->courier_id !== null) {
            return response()->json([
                'message' => 'Order already accepted',
            ], 400);
        } else if ($order->status == 'cancelled') {
            return response()->json([
                'message' => 'Order already been cancelled',
            ], 400);
        }
        $courier = Courier::find($request->user()->id);
        $courier->live_latitude = $validated['live_latitude'];
        $courier->live_longitude = $validated['live_longitude'];
        $courier->save();

        $order->courier_id = $request->user()->id;
        $order->status = 'accepted';
        $order->save();

        $company = $order->company;
//        send webhook to company's webhook address
        WebhookService::send($company->webhook_adrress, [
            'order_id' => $order->id,
            'status' => 'accepted',
            'message' => "Your order({$order->id}) has been accepted by courier {$request->user()->name} at this time {$order->updated_at}",
        ]);

        return response()->json([
            'message' => 'Order accepted',
        ], 200);
    }

    public function pickupPackage(Request $request, Order $order)
    {
        $validated = $request->validate([
            'live_latitude' => 'required|numeric',
            'live_longitude' => 'required|numeric',
        ]);
        if ($order->courier_id != $request->user()->id) {
            return response()->json([
                'message' => 'This is not your order to pickup',
            ], 401);
        }
        $courier = Courier::find($request->user()->id);
        $courier->live_latitude = $validated['live_latitude'];
        $courier->live_longitude = $validated['live_longitude'];
        $courier->save();

        $order->status = 'picked_up';
        $order->save();

        $company = $order->company;

        WebhookService::send($company->webhook_adrress, [
            'order_id' => $order->id,
            'status' => 'picked_up',
            'message' => "Your order({$order->id}) has been pickup  by courier {$request->user()->name} at this  {$order->updated_at}",
        ]);

        return response()->json([
            'message' => 'Order picked up',
        ], 200);
    }


    public function deliverPackage(Request $request, Order $order)
    {
        if ($order->courier_id != $request->user()->id) {
            return response()->json([
                'message' => 'This is not your order to deliver',
            ], 401);
        }

        $order->status = 'delivered';
        $order->save();

        $company = $order->company;

        WebhookService::send($company->webhook_adrress, [
            'order_id' => $order->id,
            'status' => 'delivered',
            'message' => "Your order({$order->id}) has been delivered by courier {$request->user()->name} at this time {$order->updated_at}",
        ]);

        return response()->json([
            'message' => 'Order delivered',
        ], 200);
    }

    public function submitDelivery(Request $request)
    {
        $validated = $request->validate([
            'api_key' => 'required',
            'start_latitude' => 'required|between:-90,90',
            'start_longitude' => 'required|between:-120,120',
            'delivery_address' => 'required',
            'delivery_provider_name' => 'required',
            'delivery_provider_mobile' => 'required',
            'destination_latitude' => 'required|between:-90,90',
            'destination_longitude' => 'required|between:-120,120',
            'destination_address' => 'required',
            'recipient_name' => 'required',
            'recipient_mobile' => 'required',
        ]);

        $company = Company::where('api_key', $validated['api_key'])->first();

        $order = new Order();
        $order->start_latitude = $validated['start_latitude'];
        $order->start_longitude = $validated['start_longitude'];
        $order->delivery_address = $validated['delivery_address'];
        $order->delivery_provider_name = $validated['delivery_provider_name'];
        $order->delivery_provider_mobile = $validated['delivery_provider_mobile'];
        $order->destination_latitude = $validated['destination_latitude'];
        $order->destination_longitude = $validated['destination_longitude'];
        $order->destination_address = $validated['destination_address'];
        $order->recipient_name = $validated['recipient_name'];
        $order->recipient_mobile = $validated['recipient_mobile'];
        $order->company_id = $company->id;
        $order->status = 'pending';
        $order->save();

        return response()->json([
            'message' => 'Order submitted',
        ], 200);
    }

    public function cancelOrder(Request $request, Order $order)
    {
        $validated = $request->validate([
            'api_key' => 'required',
        ]);

        $company = Company::where('api_key', $validated['api_key'])->first();
//        if the package is not the company's package
        if ($order->company_id != $company->id) {
            return response()->json([
                'message' => "This is not your company's order",
            ], 401);
        } else if ($order->courier_id != null && $order->status != 'pending') {
            return response()->json([
                'message' => "This order has status of {$order->status}, you are not allowed to cancel it",
            ], 400);
        }

        $order->status = 'cancelled';
        $order->save();


        return response()->json([
            'message' => 'Order cancelled',
        ], 200);
    }
}
