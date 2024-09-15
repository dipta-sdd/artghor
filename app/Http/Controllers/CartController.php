<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Colorfamily;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
            'colorfamilies_id' => 'nullable|integer',
        ]);

        $product = Product::findOrFail($product_id);
        $user = Auth::guard('api')->user();
        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->when($request->has('colorfamilies_id'), function ($query) use ($request) {
                $query->where('colorfamilies_id', $request->colorfamilies_id);
            })
            ->first();

        if ($cart) {
            $cart->increment('quantity', $validatedData['quantity']);
        } else {
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $product_id,
                'colorfamilies_id' => $request->colorfamilies_id,
                'quantity' => $validatedData['quantity'],
            ]);
        }
        $totalQuantity = Cart::where('user_id', $user->id)->sum('quantity');

        return response()->json([
            'message' => 'Product added to cart',
            'cart' => $cart,
            'totalQuantity' => $totalQuantity
        ]);
    }

    public function removeFromCart(Cart $cart)
    {
        $cart->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }

    public function updateCart(Request $request, Cart $cart)
    {
        $cart->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart item updated', 'cart' => $cart]);
    }

    public function showCart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return response()->json(['carts' => $carts]);
    }
}
