<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;    

class POS extends Controller
{
    public function index()
    {
        return view('pages.pos');
    }

    public function addToCart(Request $request)
    {
        $product = $request->input('product');
        $quantity = $request->input('quantity', 1);

        
        return response()->json([
            'message' => 'Product added to cart',
            'product' => $product,
            'quantity' => $quantity,
        ]);
    }
}