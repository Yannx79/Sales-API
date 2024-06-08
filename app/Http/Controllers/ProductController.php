<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::active()
            ->orderBy('category', 'asc')
            ->orderBy('description', 'asc')
            ->paginate(10);
        return $products;
        $data = [
            'products' => $products,
            'status' => 200,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        if (!$product) {
            $data = [
                'message' => 'Product not found!',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'product' => $product,
            'status' => 201,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::find($product->id);
        if (!$product) {
            $data = [
                'message' => 'Product not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'product' => $product,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = Product::find($product->id);
        if (!$product) {
            $data = [
                'message' => 'Product not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $product->update($request->all());
        $data = [
            'product' => $product,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        if (!$product) {
            $data = [
                'message' => 'Product not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }
}
