<?php

namespace Lara\Cart\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class CartController
 * @package Lara\Cart\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        return view('cart::carts.index');
    }
}