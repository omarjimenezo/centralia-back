<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\V1\OrderResource;

class ProviderController extends Controller
{
	public function orderList() {
        $orders = Order::where('provider_id', \Auth::user()->id)
                        ->orderBy('id','desc')
                        ->get();

        return OrderResource::collection($orders);
	}
}

