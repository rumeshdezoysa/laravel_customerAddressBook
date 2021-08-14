<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\CustomerController;

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


// Route::prefix('api')->group(function() {
//     //get all customers
//     Route::get('getCustomers', [CustomerController::class, 'getCustomers']);
//     //save customer
//     Route::post('save_Customer', [CustomerController::class, 'save_Customer']);
// });