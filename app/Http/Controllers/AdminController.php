<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function showOrder($id)
    {
        // Fetch the order, eager loading both the user and the items
        $order = Order::with(['user', 'items'])->findOrFail($id);
        
        return view('admin.order-details', compact('order'));
    }
}