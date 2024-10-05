<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Colorfamily;
use App\Models\DeleveryOffer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string',
        ]);

        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::guard('api')->user()->id)
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }
        if ($validatedData['type'] == 'add') {
            $cart->increment('quantity', $validatedData['quantity']);
        } else {
            $cart->decrement('quantity', $validatedData['quantity']);
        }
        return response()->json(['message' => 'Cart successfully updated']);
    }

    public function delete($id)
    {

        try {
            Cart::find($id)->delete();
            return response()->json(['message' => 'Product removed from cart']);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function checkout(Request $request)
    {
        // $data = json_decode($request->input('carts'), true);
        $data = $request->carts;

        $user = Auth::guard('api')->user();
        // Start database transaction
        DB::beginTransaction();
        try {
            // delete older checkout
            Order::where('user_id', $user->id)
                ->where('status', 'initialized')
                ->delete();
            // Create Order
            $order = new Order;
            $order->user_id = $user->id;
            $order->status = 'initialized';
            $order->save();

            foreach ($data as $cartId) {

                $cartItem = Cart::find($cartId);

                if (!$cartItem) {
                    continue;
                }
                $product = Product::find($cartItem->product_id);

                if (!$product) {
                    continue; // Skip if product not found
                }

                $orderDetail = new OrderDetails;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cartItem->product_id;
                $orderDetail->colorfamilies_id = $cartItem->colorfamilies_id;
                $orderDetail->price = $cartItem->product->price;
                $orderDetail->quantity = $cartItem->quantity;
                $orderDetail->save();
                $cartItem->delete();
            }

            // $order->total =
            $total = OrderDetails::where('order_id', $order->id)
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->sum(DB::raw('products.price * order_details.quantity'));
            $order->total = $total;
            $delevery_offer = DeleveryOffer::find(1);
            if ($delevery_offer->offer_at && $delevery_offer->offer_at <= $total) {
                $order->delevery_fee = $delevery_offer->offer;
            } else {
                $order->delevery_fee = $delevery_offer->fee;
            }

            // dd(json_encode($order));
            $order->save();

            // Commit transaction on success
            DB::commit();

            return response()->json(['message' => 'Order created successfully', 'order' => $order, 'delevery' => $delevery_offer],);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            return response()->json(['error' => 'Failed to create order', 'message' => $e->getMessage()], 500);
        }
    }

    public function confirmOrder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'payment_type' => 'required|string',
            'district' => 'required|string|max:255',
            'thana' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'address' => 'required|string',
            'bkash_no' => 'required_if:payment_type,==,Bkash',
            'trans_id' => 'nullable|string|max:255',
        ]);

        $validatedData['status'] = 'pending';
        $order = Order::findOrFail($id);
        $order->update($validatedData);
        $order->created_at = now();
        $order->delevery_time = now()->addDays(4)->format('Y-m-d');
        $order->save();
        return response()->json(['message' => 'Order updated successfully', 'order' => $order]);
    }



    // extra
    public function updateCart(Request $request, Cart $cart)
    {
        $cart->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart item updated', 'cart' => $cart]);
    }

    public function showCart()
    {
        $carts = Cart::where('user_id', Auth::guard('api')->user()->id)->with(['product'])
            // ->join('colorfamilies', 'carts.colorfamilies_id', '=', 'colorfamilies.id')
            // ->select('carts.*', 'colorfamilies.color_family as color_family_name')
            ->get();
        $carts = $carts->map(function ($cart) {
            if (isset($cart->colorfamilies_id)) {
                $cart->colorfamilies_id = Colorfamily::find($cart->colorfamilies_id);
            }
            return $cart;
        });
        $delevery_offer = DeleveryOffer::find(1);
        return response()->json(['carts' => $carts, 'delevery' => $delevery_offer]);
    }
}
