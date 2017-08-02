<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{

    public function create()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        $items = session('cart', []);
        if (empty($items)) {
            die("Not items to order");
        }

        $items = json_encode(Cart::getItems());
        $user_id = Auth::user()->id;

        $orderModel = new Order;
        $orderModel->user_id = $user_id;
        $orderModel->items = $items;
        $res = $orderModel->save();

        if (!$res) {
            die ('Database Error');
        }
        session()->forget('cart');
        return view('order_success');
    }

    public function all()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $user_id = Auth::user()->id;

        $orderModel = new Order;
        $orders = $orderModel->getOrdersByUser($user_id, 5);

        if (empty($orders)) {
            die("You have no orders");
        }

        foreach ($orders as $order) {
            $order->items = json_decode($order->items);
            foreach ($order->items as $item) {
                $order->total_price += $item->price * $item->count;
            }
        }

        return view('orders_list', ['orders' => $orders]);
    }

}
