<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddCoupenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    
    public function rules()
    {
        return [
            'coupon_code'=>array('required','unique:coupons,coupon_code'),
            'expiry_date'=>array('required','date_format:Y-m-d H:i:s'),
            'type'=>array('required',Rule::in(['percentdiscount', 'dollardiscount'])),
            'discount'=>array('required','numeric')
        ];
    }
}
