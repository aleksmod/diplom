<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Input;

class ItemsController extends Controller
{
    public function showItemsByCategory($slug)
    {
        // получаем список родительских категорий
        $categories = Category::whereNull('parent_id')->get();

        // получаем name активной категории
        $categoryModel = new Category();
        $active_category = $categoryModel->getCategory('slug', $slug);
        $title = mb_strtoupper($active_category->name);

        // получаем товвары по category_slug
        $itemModel = new Item();
        $items = $itemModel->getItemsByCategorySlug($slug, 12);

        if (!$categories || ! $items) {
            die('Database error');
        }

        return view('itemsByCategory', [
                'categories' => $categories,
                'title' => $title,
                'items' => $items
            ]
        );
    }

    public function itemInfo(Request $request)
    {
        $slug = $request->route('slug');
        $itemModel = new Item();
        // получаем товвар по slug
        $item = $itemModel->getItemBySlug($slug);

        return view('showItemInfo', ['item' => $item]);

    }

    public function searchItems()
    {
        $input = Input::get('search', '');
        if (empty ($input)) {
            return redirect()->back();
        }
        $keyword = htmlspecialchars(trim($input));
        $itemModel = new Item;
        $items = $itemModel->search($keyword, 20);

        if (!$items) {
            die ('Nothing found on your request');
        }

        return view('showSearchResult', ['items' => $items]);

    }

}
