<?php

namespace App\Http\Requests\Itinerary;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItineraryRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'nullable|numeric',
            'website' => 'nullable|url',
            'organizer_email' => 'nullable|email',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ];
    }
}
