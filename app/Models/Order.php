<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'items',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function getOrders($limit)
    {
        $res = Order::take($limit)->orderBy('date', 'desc')->get();
        if (!$res) {
            die('Database error');
        }
        return $res;
    }

    public function getOrdersByUser($user_id, $limit)
    {
        $res = Order::where('user_id', $user_id)->orderBy('date', 'desc')->take($limit)->get();
        if (!$res) {
            die('Database error');
        }
        return $res;
    }
}
