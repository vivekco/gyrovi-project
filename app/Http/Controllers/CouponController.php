<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\AddCoupenRequest;
use App\Http\Requests\ApplyCouponRequest;
use App\Http\Requests\DeleteCouponRequest;
use App\Http\Requests\UpdateCouponRequest;

class CouponController extends Controller
{
    public function addCoupon(AddCoupenRequest $request){
     $input = $request->validated();
     Coupon::create($input);
     return response()->json(["data"=>array("status"=>"success")],201);
    }

    public function updateCoupon(UpdateCouponRequest $request){
        $input = $request->validated();
        $coupon = Coupon::find($input['id']);
        $coupon->coupon_code = $input['coupon_code'];
        $coupon->type = $input['type'];
        $coupon->expiry_date = $input['expiry_date'];
        $coupon->discount = $input['discount'];
        $coupon->save();
        return response()->json(["data"=>array("status"=>"success")],200);
    }

    public function deleteCoupon(DeleteCouponRequest $request){
        $input = $request->validated();
        $coupon = Coupon::find($input['id']);
        $coupon->delete();
        return response()->json(["data"=>array("status"=>"success")],200);
    }
    
    public function applyCoupon(ApplyCouponRequest $request){
      $input = $request->validated();
      $coupon = Coupon::where('coupon_code', '=', $input['coupon_code'])->get();
      if(sizeof($coupon) == 1){
        $coupon = $coupon[0];
        //if($coupon->expiry_date > date(''))
        if($coupon->type == "percentdiscount"){
          $this->discountAmount = $coupon->discount*$input['price']/100;
        } else {
          $this->discountAmount = $coupon->discount; 
        }
      } else {
        return response()->json(["data"=>array("status"=>"Coupon Code Not Found")],404);
      }
      
    }
    
}
