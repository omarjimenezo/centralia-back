<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($provider)
    {
        $products = Product::where('user_id', $provider)
                           ->orderBy('description','asc')
                           ->get();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->user_id     = \Auth::user()->id;
        $product->sku         = $request->sku;
        $product->code        = $request->code;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->exist       = $request->exist;
        $product->visible     = $request->visible;
        $product->category    = $request->category;
        $product->save();

        return response()->json(['message' => 'Success', 'code' => 0], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($product->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden', 'code' => 1], 403);
        }

        $product->user_id     = \Auth::user()->id;
        $product->sku         = $request->sku;
        $product->code        = $request->code;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->exist       = $request->exist;
        $product->visible     = $request->visible;
        $product->category    = $request->category;
        $product->save();

        return response()->json(['message' => 'Success', 'code' => 0], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden', 'code' => 1], 403);
        }

        $product->delete();
        return response()->json(['message' => 'Success', 'code' => 0], 200);
    }
}
