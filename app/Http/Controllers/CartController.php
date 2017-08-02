<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::getItems();

        $total = 0;
        foreach ($items as $item) {
            $total += $item['count'] * $item['price'];
        }

        return view('cart', ['items' => $items,
                                   'total' => $total]);

    }

    public function add($id = null)
    {
        $item_id = $id ?: $_GET['id'];
        $cart_items = session('cart', []);


        if(!isset($cart_items[$item_id]['count'])) {
            $cart_items[$item_id]['count'] = 1;
        } else {
            $cart_items[$item_id]['count'] += 1;
        }

        session()->put('cart', $cart_items);

        return redirect()->back();

    }

    public function inc(Request $request)
    {
        $item_id = $request->route('id');

        // получаем товары по категории через метод hasOne модели Item
        $itemModel = new Item();
        $item = $itemModel::find($item_id)->item;

        if(!$item) {
            return view('404');
        }
        $this->add($item_id);

        return redirect()->back();
    }

    public function dec(Request $request)
    {
        $item_id = $request->route('id');

// получаем товары по категории через метод hasOne модели Item
        $itemModel = new Item();
        $item = $itemModel::find($item_id)->item;

        if(!$item) {
            return view('404');
        }

        $cart_items = session('cart', []);

        $cart_items[$item_id]['count'] -= 1;
        session()->put('cart',  $cart_items);

        if($cart_items[$item_id]['count'] < 1) {
            $this->remove($item_id);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function remove($id = null) {

        $item_id = $id ?: $_GET['id'];
        $items = session('cart', []);

        if(!isset($items[$item_id])) {
             return redirect()->back();
        }

        unset($items[$item_id]);

        session()->put('cart', $items);

        return redirect()->route('cart');

    }






}
