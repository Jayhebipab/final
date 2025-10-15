<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('partials.maintenance.products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        Products::create($request->all());

        // 🔥 balik sa dashboard?page=products
        return redirect()->route('dashboard', ['page' => 'products'])
                         ->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $products = Products::all();

        // 🔥 ipasa sa parehong view para di ka lumipat ng URL
        return view('partials.maintenance.products', compact('products', 'product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        $product = Products::findOrFail($id);
        $product->update($request->all());

        // 🔥 balik sa dashboard?page=products
        return redirect()->route('dashboard', ['page' => 'products'])
                         ->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        // 🔥 balik din dito
        return redirect()->route('dashboard', ['page' => 'products'])
                         ->with('success', 'Product deleted successfully!');
    }
}
