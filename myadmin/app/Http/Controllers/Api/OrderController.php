<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            \Log::info('Received order data', $request->all());

            $validated = $request->validate([
                'id' => 'required|integer',
                'customer_name' => 'required|string',
                'customer_email' => 'required|email',
                'status' => 'required|string',
                'total_amount' => 'required|numeric',
                'items' => 'required|array',
                'address' => 'nullable|array'  
            ]);

            
            $existingOrder = Order::where('original_id', $validated['id'])->first();
            if ($existingOrder) {
                \Log::info('Order already exists, updating', ['order_id' => $validated['id']]);
                $existingOrder->update([
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'status' => $validated['status'],
                    'total_amount' => $validated['total_amount'],
                    'items' => $validated['items'],
                    'address' => $request->input('address', [])  // Use request input with default empty array
                ]);
                $order = $existingOrder;
            } else {
                \Log::info('Creating new order', ['order_id' => $validated['id']]);
                $order = Order::create([
                    'original_id' => $validated['id'],
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'status' => $validated['status'],
                    'total_amount' => $validated['total_amount'],
                    'items' => $validated['items'],
                    'address' => $request->input('address', [])  // Use request input with default empty array
                ]);
            }

            \Log::info('Order processed successfully', ['order_id' => $order->id]);

            return response()->json([
                'success' => true,
                'message' => 'Order processed successfully',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Order processing failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Order processing failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}