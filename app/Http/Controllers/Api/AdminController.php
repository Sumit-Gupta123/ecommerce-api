<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getUsers()
    {
        // Fetch all users ordered by newest first
        return response()->json(User::latest()->get());
    }

    public function function getOrders()
    {
        // Fetch orders and include the associated user's name and email
        $orders = Order::with('user:id,name,email')->latest()->get();
        return response()->json($orders);
    }
}
