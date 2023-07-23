<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function cart()
    {
        return view('Cart.index');
    }

    public function update(Request $request)
    {
        // if($request->id && $request->quantity){
        //     $cart = session()->get('cart');
        //     $cart[$request->id]["quantity"] = $request->quantity;
        //     session()->put('cart', $cart);
        //     session()->flash('success', 'Cart successfully updated!');
        // }

        if ($request->id && $request->quantity) {
            $cartKey = auth()->check() ? 'cart_' . auth()->user()->id : 'cart';
            $cart = Cache::get($cartKey, []);

            if (isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                Cache::put($cartKey, $cart);
                session()->flash('success', 'Cart successfully updated!');
            }
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}
