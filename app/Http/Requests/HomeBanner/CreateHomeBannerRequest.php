<?php

namespace App\Http\Requests\HomeBanner;

use Illuminate\Foundation\Http\FormRequest;

class CreateHomeBannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:225',
            'order_by' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
