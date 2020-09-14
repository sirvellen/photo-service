<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        return $category->products;
    }

    public function show(Category $category, Product $product)
    {
        return $product;
    }

    public function store(Category $category, ProductRequest $request)
    {


        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'photo_url' => $this->uploadFile($request->file('photo')),
            'categories_id' => $category->id,
        ]);

        return $product;
    }

    public function update(Category $category, Product $product, ProductUpdateRequest $request)
    {
        $update = [];

        if ($request->file('photo')) {
            $update['photo_url'] = $this->uploadFile($request->file('photo'));
        }

        $product->update(array_merge($request->all(), $update));

        return response()->json($product)->setStatusCode(201, 'Successful Update');
    }

    public function destroy(Category $category, Product $product)
    {
        $product -> delete();

        return response()->json([
            'message' => 'Success delete'
        ])->setStatusCode(201, 'Success delete');
    }

    public function uploadFile($file)
    {
        $fileName = uniqid() . '.' . $file->extension();
        $fullDir = 'public/images';

        return $file->move($fullDir, $fileName);
    }
}
