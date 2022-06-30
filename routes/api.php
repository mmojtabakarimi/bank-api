<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function () {

    Route::post('customer', [CustomerController::class, 'AddCustomer']);
    Route::get('customers', [CustomerController::class, 'ListCustomers']);

    Route::post('addcard', [CardController::class, 'AddCard']);
    Route::get('cards', [CardController::class, 'ListCards']);
    Route::get('card/{customerId}', [CardController::class, 'ListCustomerCard']);


    Route::post('transfer', [PaymentController::class, 'DoPayment']);
    Route::get('transfers/{count}', [PaymentController::class, 'listPaymentByCount']);
    Route::get('costs/{count}', [PaymentController::class, 'listCostByCount']);


});
