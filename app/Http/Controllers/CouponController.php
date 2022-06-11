<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\AppliedCoupon;
use Illuminate\Support\Carbon;
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
        if($coupon){
        $coupon->coupon_code = $input['coupon_code'];
        $coupon->type = $input['type'];
        $coupon->expiry_date = $input['expiry_date'];
        $coupon->discount = $input['discount'];
        $coupon->save();
        return response()->json(["data"=>array("status"=>"success")],200);
        } else {
        return response()->json(["data"=>array("status"=>"Coupon not found!")],404);
        }
    }

    public function deleteCoupon($id){
        $request = new DeleteCouponRequest();
        //$input = $request->validated();
        $coupon = Coupon::find($id);
        $response = array();
        $code = 200;
        if ($coupon){
        $coupon->delete();
        $response = ["data"=>array("status"=>"success")];
        } else {
            $response = ["data"=>array("status"=>"Coupon not found!")];
            $code = 404; 
        
        }
        return response()->json($response,$code);
    }
    
    public function applyCoupon(ApplyCouponRequest $request){
      $input = $request->validated();
      $coupon = Coupon::where('coupon_code', '=', $input['coupon_code'])->get();
      $nowTime = date('Y-m-d H:i:s');
      $response = array();
      $code = 201;
      if(sizeof($coupon) == 1){
        $coupon = $coupon[0];
        if($coupon->expiry_date > $nowTime){
        if($coupon->type == "percentdiscount"){
          $this->discountAmount = $coupon->discount*$input['price']/100;
        } else {
          $this->discountAmount = $coupon->discount; 
        }
        $response = ["data"=>array("status"=>"Success","price"=>array("original_price"=>$input['price'],"discount"=>$this->discountAmount))];
        } else {
            $response = ["data"=>array("status"=>"Coupon Expired!")];
        }
      } else {
        $response = ["data"=>array("status"=>"Coupon Code Not Found!")];
      }
      $couponLog = array("coupon_code"=>$input['coupon_code'],"request"=>json_encode($input),"response"=>json_encode($response));
      AppliedCoupon::create($couponLog);      
      return response()->json($response,$code);      
    }

    public function getCouponLog($coupon_code){
        $appliedArray = array();
        $appliedCoupons = AppliedCoupon::where('coupon_code', '=', $coupon_code)->get();
        $i = 0;
        if(sizeof($appliedCoupons) > 0){
        foreach ($appliedCoupons as $appliedCoupon) {
             $appliedArray[$i]["applied on"] = $appliedCoupon->created_at;
             $response = json_decode($appliedCoupon->response);
             $appliedArray[$i]["redeem_status"] = $response->data->status;
             $i += 1;
        }
        return response()->json(["data"=>array("status"=>"success","appliedCoupon"=>$appliedArray)],404);
        } else {
            return response()->json(["data"=>array("status"=>"Coupon not found!")],404);
        }
    }
    
}
