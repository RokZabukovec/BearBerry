<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function total()
    {
        $total = 0;
        $items = $this->items()->get();
        foreach ($items as $item)
        {
            $total += $item->price;
        }
        return $total;
    }
}
