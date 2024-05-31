<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $low_price_products = Product::where('price', '<', 100)
            ->orderBy('price', 'desc')
            ->with('category:title,id')
            ->get();

        return Response::json($low_price_products)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required | min:3 | max:255 | string',
            'price' => 'required | int',
            'quantity' => 'required | int',
            'image' => 'nullable | string | min:5 | max:255',
            'description' => 'required | min:5 | max:255 | string',
            'category_id' => 'required | int | exists:categories,id',
        ]);

        $posts = Product::create($attributes);
        return Response::json($posts)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Response::json($product->load('category'))->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'title' => 'sometimes | min:3 | max:255 | string',
            'price' => 'sometimes | int',
            'quantity' => 'sometimes | int',
            'image' => 'sometimes | string | min:5 | max:255',
            'description' => 'sometimes | min:5 | max:255 | string',

        ]);

        $product->update($attributes);
        return Response::json($product)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Response::json($product)->setStatusCode(204);
    }
}
