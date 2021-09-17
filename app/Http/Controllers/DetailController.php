<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        return view('pages.detail', [
            'product' => $product,
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'product_id' => $id,
            'user_id' => auth()->user()->id,
        ];

        Cart::create($data);

        return redirect()->route('carts');
    }
}
