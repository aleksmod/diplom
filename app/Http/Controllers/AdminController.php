<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{

    public function index()
    {
        if (!Auth::check() || !$this->isAdmin()){
            return redirect(route('home'));
        }
        $orderModel = new Order;
        $orders = $orderModel->getOrders(10);

        if (!$orders) {
            die ('error');
        }

        foreach ($orders as $order) {
        $order['items'] = json_decode($order['items']);
        }

        return view('admin.admin_index', ['orders' => $orders]);
    }

    public function isAdmin()
    {
        if (Auth::user()->name === 'Admin') {
            // password: admin123
            return true;
        }
    }

    public function showAllUsers()
    {
        $userModel = new User;
        $users = $userModel->users(10);
//        dd($users);
        if (!$users) {
            die ('error');
        }
        return view('admin.admin_users', ['users' => $users]);

    }

    public function showAllItems()
    {
        // получаем список категорий
        $categories = Category::whereNull('parent_id')->take(20)->get();

        // получаем все товары с лимитированным выводом на странице
        $itemModel = new Item();
        $items = $itemModel->getItems(6);

        if (!$items || !$categories) {
            return view('404');
        }
        return view('admin.admin_items', [
            'categories' => $categories,
                'items' => $items
            ]);
    }

    public function showItemsByCategory($slug)
    {
        // получаем список категорий
        $categories = Category::whereNull('parent_id')->get();//выводим основные меню

        // получаем товвары по category_slug
        $itemModel = new Item();
        $items = $itemModel->getItemsByCategorySlug($slug, 6);

        if (!$items || !$categories) {
            return view('404');
        }

        return view('admin.admin_ItemsByCategory', [
            'categories' => $categories,
                'items' => $items
            ]);
    }

    public function itemInfo(Request $request)
    {
        $id = $request->route('id');

        // получаем товары по категории через метод hasOne модели Item
        $itemModel = new Item();
        $item = $itemModel::find($id)->item;

        if (!$item) {
            return view('404');
        }
        return view('admin.admin_itemInfo', ['item' => $item]);

    }

    public function showAllCategories()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getCategories(12);

        if (!$categories) {
            return view('404');
        }
        return view('admin.admin_categories', ['categories' => $categories]);
    }

    public function addCategory(Request $request) //
    {
        $this->validate($request, [
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:20'
        ]);

        $data = $request->toArray();

        $categoryModel = new Category;
        $res = $categoryModel->createCategory($data);

        if (!$res ) {
            die('Category was not created!');
        }

        return redirect()->route('categories');
    }

    public function categoryRemove (Request $request)
    {
        $categoryModel = new Category();
        $res = $categoryModel->where('id',  $request->id)->delete();

        if (!$res ) {
            die('Category was not deleted!');
        }

        return redirect()->route('categories');

    }

    public function categoryUpdate(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:20'
        ]);

        $categoryModel = new Category();
        $res = $categoryModel->where('id', $request->id)
            ->update([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => $request->slug
            ]);

        if (!$res ) {
            die('Category was not updated!');
        }

        return redirect()->route('categories');
    }

   public function addItemsForm()
    {
        // получаем список родительских категорий
        $parent_categories = Category::whereNull('parent_id')->take(30)->get();
        // получаем список  дочерних категорий
        $categories = Category::whereNotNull('parent_id')->take(70)->get();

        if (!$parent_categories || !$categories) {
            return view('errors.404');
        }

        return view('admin.admin_add_item', [
            'categories' => $categories,
            'parent_categories' => $parent_categories,
        ]);
    }

    public function addNewItem (Request $request)
    {
        $this->validator($request);
        $image_name = self::uploadImage($request);
        $data = $request->toArray();
        $itemModel = new Item();
        $res = $itemModel->createItem($data, $image_name);

        if (!$res ) {
            die('Database error! New item was not created!');
        }

        return redirect()->route('items');
    }

    public function itemRemove(Request $request)
    {
        $id = $request->route('id');
        $item = new Item();
        $res = $item->where('id', '=', $id)->delete();

        if (!$res ) {
            die('Database error! Item was not deleted!');
        }

        return redirect()->back();
    }

    public function itemUpdate(Request $request)
    {
        $id = $request->route('id');
        // получаем список родительских категорий
        $parent_categories = Category::whereNull('parent_id')->take(30)->get();
        // получаем список  дочерних категорий
        $categories = Category::whereNotNull('parent_id')->take(70)->get();

        $itemModel = new Item();
        $item = $itemModel->where('id', '=', $id)->get()->first();
        if(!$item) {
            return view('errors.404');
        }
        return view('admin.admin_itemUpdate', [
            'categories' => $categories,
            'parent_categories' => $parent_categories,
            'item' => $item
        ]);
    }

    public function itemSave(Request $request)
    {
        $this->validator($request);
        $image_name = self::uploadImage($request);
        $data = $request->except('_token', 'input_image');
        $id = $request->id;
        $item = new Item();
        $res = $item->updateItem($id, $data, $image_name);

        if (!$res ) {
            die('Database error! Item was not updated!');
        }

        return redirect()->route('items');
    }

    public function validator($data)
    {
            $this->validate($data, [
            'category_id' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'slug' => 'required|string|max:30',
            'name' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'price' => 'required|integer',
            'image' => 'image|max: 200'
        ]);

    }

    public static function uploadImage(Request $request)
    {
        if ($request->hasFile('input_image')) {
            if($request->file('input_image')->isValid()) {

                $img = $request->file('input_image');
                $ext = $img->getClientOriginalExtension();
                $image_resize = Image::make($img)->resize(250, 200);
                $image_name = time().'.'.$ext;
                $image_resize->save(public_path('images') . '/' . $image_name);
                return $image_name;
            }
        }
    }
}




