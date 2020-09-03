<?php


namespace App\Repositories;

use App\User;
use App\Store;

class StoreRepository
{

    public function all()
    {
        return Store::all();
    }
}
