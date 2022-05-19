<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dependency;
use Illuminate\Http\Request;
use App\Http\Resources\V1\OrderResource;

class ProviderController extends Controller
{
	public function orderList() {
        if(\Auth::user()->user_type == 2) {
            $orders = Order::where('provider_id', \Auth::user()->id)
                            ->orderBy('created_at','desc')
                            ->get();
        } else if(\Auth::user()->user_type == 1) {
            $ids_array = Dependency::select('sub_user_id')
                                    ->where('sup_user_id',\Auth::user()->id)
                                    ->get()
                                    ->toArray();

            array_push($ids_array, \Auth::user()->id);
            $orders = Order::whereIn('provider_id', $ids_array)
                            ->orderBy('created_at','desc')
                            ->get();
        }

        return OrderResource::collection($orders);
    }
}

