<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function forbidden()
    {
        return view('errors.forbidden');
    }
}
