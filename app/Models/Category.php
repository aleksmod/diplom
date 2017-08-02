<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = ['parent_id', 'name', 'slug'];

    public function subCategory() //Чтобы вывести подкатегории
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id');
    }

    public function getCategory($key, $value)
    {
        return Category::where($key, '=', $value)->firstOrFail();
    }

    public function getCategories($page_limit)
    {
        return Category::paginate($page_limit);
    }

    public function createCategory($data)
    {
        return Category::create($data);
    }

    /*public function updateCategory($data, $id)
    {
        return Category::where('id', $id)
            ->update([
            'parent' => $data->parent_id,
            'name' => $data->name,
            'slug' => $data->slug
        ]);

    }*/


}
