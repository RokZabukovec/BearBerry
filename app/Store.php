<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name'];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
