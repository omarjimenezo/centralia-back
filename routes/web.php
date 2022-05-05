<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/migrate', function () {
    \Artisan::call('migrate');
    return 'PHP artisan migrate';
});

Route::get('/seed', function () {
    \Artisan::call('db:seed', array('--class' => 'DatabaseSeeder')); 
    return 'php artisan db:seed --class=DatabaseSeeder';
});

