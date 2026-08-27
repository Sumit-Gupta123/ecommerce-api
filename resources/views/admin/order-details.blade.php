@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders') }}" class="text-gray-500 hover:text-gray-800">&larr; Back to Orders</a>
            <h1 class="text-3xl font-bold text-gray-800">Order #{{ $order->id }}</h1>
            <span class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-sm font-semibold uppercase tracking-wide">
                {{ $order->status }}
            </span>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Placed on</p>
            <p class="font-medium text-gray-900">{{ $order->created_at->format('F j, Y, g:i a') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Customer Card -->
        <div class="bg-white p-6 rounded-lg shadow border border-gray-200 md:col-span-1">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Customer Details</h2>
            <div class="space-y-2">
                <p><span class="font-medium text-gray-700">Name:</span> {{ $order->user->name ?? 'Unknown' }}</p>
                <p><span class="font-medium text-gray-700">Email:</span> {{ $order->user->email ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-white p-6 rounded-lg shadow border border-gray-200 md:col-span-2">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Financial Summary</h2>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-600">Shipping</span>
                <span class="font-medium text-green-600">Free</span>
            </div>
            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                <span class="text-xl font-bold text-gray-900">Total</span>
                <span class="text-2xl font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <h2 class="text-xl font-bold text-gray-900 mb-4">Purchased Items</h2>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-4 font-medium text-gray-500">Product</th>
                    <th class="px-6 py-4 font-medium text-gray-500 text-center">Quantity</th>
                    <th class="px-6 py-4 font-medium text-gray-500 text-right">Unit Price</th>
                    <th class="px-6 py-4 font-medium text-gray-500 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($order->items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $item->product_name }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $item->product_id }}</div>
                        </td>
                        <td class="px-6 py-4 text-center font-medium text-gray-700">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4 text-right text-gray-600">
                            ${{ number_format($item->price, 2) }}
                        </td>
                        <td class="px-6 py-4 text-right font-medium text-gray-900">
                            ${{ number_format($item->price * $item->quantity, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            No items recorded for this order.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection