<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return Response::json($categories)->setStatusCode(200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required | unique:categories,title | min:5 | max:255 | string',
        ]);

        $categories = Category::create($attributes);
        return Response::json($categories)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return Response::json($category ->load('products'))->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $attributes = $request->validate([
            'title' => 'sometimes | unique:categories,title | min:5 | max:255 | string',
        ]);

        $category->update($attributes);
        return Response::json($category)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Response::json($category)->setStatusCode(204);
    }
}
