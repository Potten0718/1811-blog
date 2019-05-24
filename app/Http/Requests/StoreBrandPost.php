<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name'=>'required|unique:brand|max:10',
            'brand_logo'=>'required',
            'brand_url'=>'required',
            'brand_desc'=>'required',
        ];
    }

    //自定义验证信息
    public function messages(){     
        return [         
            'brand_name.required'=>'商品名不能为空！',
            'brand_logo.required'=>'商品logo不能为空！',
            'brand_url.required'=>'商品网址不能为空！',
            'brand_desc.required'=>'商品详情不能为空！',    
        ];
    }

}
