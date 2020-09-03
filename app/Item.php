<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'category_id', 'price', 'quantity', 'image'];

    public function owner()
    {
        return $this->belongsTo(Store::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
