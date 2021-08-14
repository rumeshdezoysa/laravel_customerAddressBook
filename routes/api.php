<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CustomerController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


    //get all customers
    Route::get('getCustomers', [CustomerController::class, 'getCustomers']);

    //get  customer
    Route::get('get_customer/{id}', [CustomerController::class, 'get_customer']);

    //save customer
    Route::post('save_customer', [CustomerController::class, 'save_customer']);

    //update  customer
    Route::post('update_customer/{id}', [CustomerController::class, 'update_customer']);


    Route::delete('delete_customer/{id}', [CustomerController::class, 'delete_customer']);


    //search customer

    Route::get('customer/search', [CustomerController::class, 'searchCustomer']);