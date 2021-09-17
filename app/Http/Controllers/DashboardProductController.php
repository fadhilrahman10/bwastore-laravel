<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\ProductGalleryRequest;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])->where('user_id', Auth::user()->id)->get();
        return view('pages.dashboard-products', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', [
            'categories' => $categories,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = [
            'product_id' => $product->id,
            'photo' => $request->file('photo')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-products')->with('success', 'New product has been added!');
    }


    public function details(Request $request, $id)
    {
        $product = Product::with(['galleries', 'category', 'user'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-products-details', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-products-details', $request->product_id)->with('success', 'New product Gallery has been added!');
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);

        $item->delete();

        return redirect()->route('dashboard-products-details', $item->product_id)->with('success', 'Product Gallery has been deleted!');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-products')->with('success', 'Product has been updated!');
    }
}
