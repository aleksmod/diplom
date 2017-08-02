<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    protected $table = 'items';

    protected $fillable = [
        'category_id', 'parent_id', /*'category', 'parent_category', */'name', 'model', 'slug', 'description', 'price', 'image'
    ];

    public function item()
    {
        return $this->hasOne('App\Models\Item', 'id');
    }

    public function getItemBySlug($slug)
    {
        return Item::where('slug', '=', $slug)->firstOrFail();
    }

    public function getItems($page_limit)
    {
        return Item::paginate($page_limit);
    }

    public function search($keyword, $limit = 10)
    {
        $res = $this->where("name", "LIKE","%$keyword%")->take($limit)->get();

        return $res;
    }

    public function getItemsByCategorySlug($slug, $page_limit = 5)
    {
        $category = Category::where('slug', '=', $slug)->first();

        if ($category->parent_id == null) {
            $items = Item::where('parent_id', '=', $category->id)->paginate($page_limit);
        } else {
            $items = Item::where('category_id', '=', $category->id)->paginate($page_limit);
        }

        return $items;
    }

    public function createItem($data, $image_name)
    {
        $data += ['image' => $image_name];
        return Item::create($data);
    }

    public function updateItem($id, $data, $image_name)
    {
        $data += ['image' => $image_name];
        return Item::where('id', $id)->update($data);
    }



}
