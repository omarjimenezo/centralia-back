<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\V1\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('provider_id', \Auth::user()->id)
                        ->orderBy('id','desc')
                        ->get();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        if (json_encode($data['description'])) {
            if ($data['provider_id'] && $data['amount']) {
                $order = new Order();
                $order->user_id = \Auth::user()->id;
                $order->provider_id = $data['provider_id'];
                $order->description = json_encode($data['description']);
                $order->amount = $data['amount'];
                $order->status = 1;
                $order->save(); 

                return response()->json(['message' => 'Success', 'code' => 0], 200);     
            } else {
                return response()->json(['message' => 'Missing required field', 'code' => 1], 400);
            }            
        } else {
            return response()->json(['message' => 'Bad request', 'code' => 1], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($order->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden', 'code' => 1], 403);
        }

        $data = $request->json()->all();

        if (json_encode($data['description'])) {
            if ($data['amount']) {
                $order->description = json_encode($data['description']);
                $order->amount = $data['amount'];


                // vaidar status
                $order->status  = $data['status'];



                $order->save(); 

                return response()->json(['message' => 'Success', 'code' => 0], 200);     
            } else {
                return response()->json(['message' => 'Missing required field', 'code' => 1], 400);
            }            
        } else {
            return response()->json(['message' => 'Bad request', 'code' => 1], 400);
        }
    }

    public function providerOrderList() {
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
    
    public function businessOrderList() {
            $orders = Order::where('user_id', \Auth::user()->id)
                            ->orderBy('created_at','desc')
                            ->get();
        

        return OrderResource::collection($orders);
    }

    public function updateOrderStatus(Request $request){
        error_log('Request: '.$request);
        $data = $request->json()->all();

        if ($request->status && $request->order_id) {
            $order = Order::find($request->order_id);
            $order->status = $request->status;
            error_log('Order Updated: '.$order);
            $order->save();
        //     $order = Order::where('id', $data['order_id'])->get();
        //     error_log('New status: '. $data['status']);
        //     $order->status = $data['status'];
        //     error_log('Order Updated: '.$order);
        //     $order->save(); 

            return response()->json(['message' => 'Success', 'code' => 0], 200);               
        } else {
            return response()->json(['message' => 'Missing required fields', 'code' => 1], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden', 'code' => 1], 403);
        }

        $order->delete();
        return response()->json(['message' => 'Success', 'code' => 0], 200);
    }
}
