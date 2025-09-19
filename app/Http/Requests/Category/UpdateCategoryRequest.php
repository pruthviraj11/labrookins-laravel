<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = decrypt($this->route('encrypted_id'));
        return [
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'title')->ignore($id)
            ],
        ];
    }
}
