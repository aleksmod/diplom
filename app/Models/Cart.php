<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function getItems()
    {
        $session_items =  session('cart', []);
        $keys = array_keys($session_items);
        if (empty($keys)) {
            return [];
        }

        $ItemModel = new Item();
        $items = $ItemModel->whereIn('id', $keys)->take(20)->get();

        $result = [];
        foreach($items as $index => $item) {
            $result[$index]['id'] = $item['id'];
            $result[$index]['name'] = $item['name'];
            $result[$index]['model'] = $item['model'];
            $result[$index]['price'] = $item['price'];
            $result[$index]['count'] = $session_items[$item['id']]['count'];
        }

        return $result;

    }
}
