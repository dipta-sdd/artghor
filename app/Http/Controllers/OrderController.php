<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colorfamily;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function adminIndex($id)
    {
        $order = Order::where('id', $id)->with(['items.product', 'items.product.category', 'items.product.subcategory'])
            ->first();
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

    public function adminUpdate(Request $req, $id)
    {

        try {
            $order = Order::find($id);
            // if ($req->has('status') && $req->status == 'processing') {
            // }
            $order->update($req->all());
            return response()->json($order, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }


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

    public function adminAll(Request $req)
    {
        $orders = Order::select('orders.*', 'users.name')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->when(
                $req->has('status'),
                function ($query) use ($req) {
                    return $query->where('status', $req->status);
                },
                function ($query) use ($req) {
                    return $query->where('status', '!=', 'imitialized');
                }
            )
            ->paginate($req->limit ? $req->limit : 5);
        if (!$orders) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($orders);
    }

    public function update(Request $req, $id)
    {

        try {
            $order = Order::find($id);
            $order->update($req->all());
            return response()->json($order, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}