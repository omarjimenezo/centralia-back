<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dependency;
use App\Http\Resources\V1\DependencyResource;

class DependencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBySupId($sup_user_id)
    {
        $dependencies = Dependency::where('sup_user_id', $sup_user_id)
                           ->orderBy('id','asc')
                           ->get();

        return DependencyResource::collection($dependencies);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBySubId($sub_user_id)
    {
        $dependencies = Dependency::where('sub_user_id', $sub_user_id)
                           ->orderBy('id','asc')
                           ->get();

        return DependencyResource::collection($dependencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dependency = new Dependency();
        $dependency->user_id     = \Auth::user()->id;
        $dependency->category_id = $request->category_id;
        $dependency->name        = $request->name;
        $dependency->save();

        return response()->json(['message' => 'Success'], 205);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function show(Dependency $dependency)
    {
        return new DependencyResource($dependency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependency $dependency)
    {
        if ($dependency->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $dependency->user_id     = \Auth::user()->id;
        $dependency->category_id = $request->category_id;
        $dependency->name        = $request->name;
        $dependency->save();

        return response()->json(['message' => 'Success'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependency $dependency)
    {
        if ($dependency->user_id != \Auth::user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $dependency->delete();
        return response()->json(['message' => 'Success'], 204);
    }
}
