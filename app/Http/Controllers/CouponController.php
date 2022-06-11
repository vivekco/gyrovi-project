<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\AddCoupenRequest;

class CouponController extends Controller
{
    public function addCoupon(AddCoupenRequest $request){
     $input = $request->validated();
     Coupon::create($input);
     return response()->json(["data"=>array("status"=>"success")],201);
    }

    public function updateCoupon(AddCoupenRequest $request){
        
    }
}
