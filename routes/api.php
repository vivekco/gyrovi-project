<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

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

Route::post("post/coupon",array(CouponController::class,'addCoupon'));
Route::put("update/coupon",array(CouponController::class,'updateCoupon'));
Route::delete("delete/coupon/{id}",array(CouponController::class,'deleteCoupon'));
Route::post("apply-coupon",array(CouponController::class,'applyCoupon'));
Route::get("/get/coupon/{id}",array(CouponController::class,'getCouponLog'));
