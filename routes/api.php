<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController as CategoryController;
use App\Http\Controllers\Api\V1\DependencyController as DependencyController;
use App\Http\Controllers\Api\V1\ProductController as ProductController;
use App\Http\Controllers\Api\V1\OrderController as OrderController;
use App\Http\Controllers\Api\V1\UserController as UserController;
use App\Http\Controllers\Api\V1\ProviderController as ProviderController;
use App\Http\Controllers\Api\LoginController as LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* - - - - - L O G I N - - - - - */

Route::post('login', [LoginController::class, 'login']);

/* - - - - - C A T E G O R I E S - - - - -

- - Public URLs - -
GET       | api/v1/category/provider/{user_id}   method index
GET       | api/v1/category/{user_id}            method show
*/

// (URL)/api/v1/category/provider/(user_id)
Route::get( 'v1/category/provider/{user_id}', [CategoryController::class, 'index']);

/* - - - - - D E P E N D E N C I E S - - - - -

- - Private URLs - -
GET       | api/v1/dependency/superior/{sub_user_id}        method index by subordinate id
GET       | api/v1/dependency/subordinates/{sup_user_id}    method index by superior id
*/

// (URL)/api/v1/category/provider/(user_id)
Route::get( 'v1/dependency/superior/{sub_user_id}', [DependencyController::class, 'indexBySubId'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/category/provider/(user_id)
Route::get( 'v1/dependency/subordinates/{sup_user_id}', [DependencyController::class, 'indexBySupId'])
     ->middleware('auth:sanctum');
/* - - - - - P R O D U C T S - - - - -

- - Public URLs - -
GET       | api/v1/catalog/provider/{provider}  method index
GET       | api/v1/product/{product}            method show

- - Private URLs - -
POST      | api/v1/product             method store
PUT       | api/v1/product/{product}   method update
DELETE    | api/v1/product/{product}   method destroy
*/

// (URL)/api/v1/catalog/provider/(provider)
Route::get( 'v1/catalog/provider/{provider}', [ProductController::class, 'index']);

// (URL)/api/v1/product/(product)
Route::get( 'v1/product/{product}', [ProductController::class, 'show']);

// (URL)/api/v1/product/
Route::post( 'v1/product', [ProductController::class, 'store'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/product/(product)
Route::put( 'v1/product/{product}', [ProductController::class, 'update'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/product/(product)
Route::delete( 'v1/product/{product}', [ProductController::class, 'destroy'])
     ->middleware('auth:sanctum');


/* - - - - - O R D E R S - - - - -

- - Public URLs - -
GET       | api/v1/orders             method index
GET       | api/v1/order/{order}      method show
POST      | api/v1/order              method store
PUT       | api/v1/order/{order}      method update
DELETE    | api/v1/order/{order}      method destroy
*/

// (URL)/api/v1/orders
Route::get('v1/orders', [OrderController::class, 'index'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/order/(order)
Route::get('v1/order/{order}', [OrderController::class, 'show'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/order
Route::post('v1/order', [OrderController::class, 'store'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/order/(order)
Route::put('v1/order/{order}', [OrderController::class, 'update'])
     ->middleware('auth:sanctum');

// (URL)/api/v1/order/(order)
Route::delete('v1/order/{order}', [OrderController::class, 'destroy'])
     ->middleware('auth:sanctum');



// (URL)/api/v1/order/(order)
Route::get('v1/user/{user}', [UserController::class, 'show']);

// (URL)/api/v1/catalog/provider/(provider)
Route::get( 'v1/userinfo', [UserController::class, 'userInfo'])
     ->middleware('auth:sanctum');




// (URL)/api/v1/orders
Route::get('v1/provider/orders', [ProviderController::class, 'orderList'])
     ->middleware('auth:sanctum');
