@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Customer Orders</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-4 font-medium text-gray-500">Order ID</th>
                    <th class="px-6 py-4 font-medium text-gray-500">Customer</th>
                    <th class="px-6 py-4 font-medium text-gray-500">Status</th>
                    <th class="px-6 py-4 font-medium text-gray-500">Total Amount</th>
                    <th class="px-6 py-4 font-medium text-gray-500">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">
                                #{{ $order->id }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $order->user->name ?? 'Deleted User' }}</div>
                            <div class="text-sm text-gray-500">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($order->status === 'paid')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold uppercase tracking-wide">Paid</span>
                            @elseif($order->status === 'pending')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold uppercase tracking-wide">Pending</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold uppercase tracking-wide">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            ${{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $order->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">View Details &rarr;</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection