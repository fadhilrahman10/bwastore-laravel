<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('user_id', auth()->user()->id)->get();
        return view('pages.cart', [
            'carts' => $carts,
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('carts');
    }

    public function success()
    {
        return view('pages.success');
    }
}
