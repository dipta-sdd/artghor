<?php

namespace App\Http\Controllers;

use App\Models\Colorfamily;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::guard('api')->user()->id)->with(['items.product'])->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $order->items = $order->items->map(function ($item) {
            if (isset($item->colorfamilies_id)) {
                $item->product->colorfamily = Colorfamily::find($item->colorfamilies_id)->color_family;
            }
            return $item;
        });

        return response()->json($order);
    }
    public function all(Request $req)
    {
        // $orders = Order::where('user_id', Auth::guard('api')->user()->id)->with(['items.product'])->get();
        $orders = Order::where('user_id', Auth::guard('api')->user()->id)->when($req->has('filter'),  function ($query) use ($req) {
            return $query->whereIn('status', json_decode($req->input('filter'), true));
        })
            ->orderBy('created_at', $req->has('sort') ? $req->sort : 'desc')
            ->with(['items.product'])->get();

        if (!$orders) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $orders = $orders->map(function ($order) {

            $order->items = $order->items->map(function ($item) {
                if (isset($item->colorfamilies_id)) {
                    $item->product->colorfamily = Colorfamily::find($item->colorfamilies_id)->color_family;
                }
                return $item;
            });
            return $order;
        });


        return response()->json($orders);
    }
}
