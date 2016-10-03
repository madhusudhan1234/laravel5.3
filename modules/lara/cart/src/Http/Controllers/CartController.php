<?php

namespace Lara\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Lara\Models\Cart;

/**
 * Class CartController
 * @package Lara\Cart\Http\Controllers
 */
class CartController extends Controller
{

    private $carts;

    public function __construct(Cart $carts)
    {
        $this->carts = $carts;
    }

    /**
     * @return string
     */
    public function index()
    {
        $carts = $this->carts->all();

        return view('cart::carts.index',compact('carts'));
    }
}