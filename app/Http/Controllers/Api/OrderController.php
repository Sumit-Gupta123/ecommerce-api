<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Fetch orders for the logged-in user, include the items, and sort by newest first
        $orders = $request->user()->orders()->with('items')->latest()->get();
        
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_amount' => ['required', 'numeric'],
            'items' => ['required', 'array'],
            'items.*.product_id' => ['required', 'integer'],
            'items.*.product_name' => ['required', 'string'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric'],
        ]);

        $order = $request->user()->orders()->create([
            'total_amount' => $validated['total_amount'],
            'status' => 'pending',
        ]);

        // Save all cart items linked to this order
        $order->items()->createMany($validated['items']);

        return response()->json([
            'message' => 'Order placed successfully!',
        ], 201);
    }
}
