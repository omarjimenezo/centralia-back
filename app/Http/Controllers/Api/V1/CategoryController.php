<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($provider)
    {
        $categories = Category::where('user_id', $provider)
                           ->orderBy('name','asc')
                           ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->user_id     = \Auth::user()->id;
        $category->category_id = $request->category_id;
        $category->name        = $request->name;
        $category->save();

        return response()->json(['message' => 'Success'], 205);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($category->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $category->user_id     = \Auth::user()->id;
        $category->category_id = $request->category_id;
        $category->name        = $request->name;
        $category->save();

        return response()->json(['message' => 'Success'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $category->delete();
        return response()->json(['message' => 'Success'], 204);
    }
}
