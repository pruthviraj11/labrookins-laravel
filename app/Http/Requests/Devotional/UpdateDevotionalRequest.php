<?php

namespace App\Http\Requests\Devotional;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDevotionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'title' => 'required|string|max:100',
            // 'description' => 'required|string',
            // 'long_description' => 'nullable|string',
            // 'page' => 'required|string|max:50',
            // 'status' => 'nullable|boolean',
        ];
    }
}
