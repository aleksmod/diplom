<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // если пользователь не авторизирован, отправляем на форму авторизации
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function test()
    {
//        $categories = Category::all();//выводим основные меню


    }

    public function index()
    {
        // получаем список родительских категорий
        $categories = Category::whereNull('parent_id')->get();

        // получаем все товары с лимитом
        $itemModel = new Item();
        $items = $itemModel->getItems(12);

        if (!$items || !$categories) {
            return view('404');
        }

        return view('home', [
            'categories' => $categories,
            'items' => $items
        ]);
    }
}
