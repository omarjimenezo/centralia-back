<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderStatusCatalog;
use Illuminate\Http\Request;
use App\Http\Resources\V1\OrderStatusCatalogResource;

class OrderStatusCatalogController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_type = new Category();
        $user_type->description = $request->description;
        $user_type->save();

        return response()->json(['message' => 'Success', 'code' => 0], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function getOrderStatusCatalog()
    {
        $orderStatusCatalog = OrderStatusCatalog::orderBy('id','asc')->get();

        return OrderStatusCatalogResource::collection($orderStatusCatalog);
    }
}
