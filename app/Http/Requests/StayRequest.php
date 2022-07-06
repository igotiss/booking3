<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StayRequest extends FormRequest
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
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'amenities' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1|max:10',
            'type' => 'required',
            'beds' => 'required|integer|min:1|max:10',
            'location' => 'required|string|max:25',
            'image' => 'nullable|max:2000|mimes:jpeg,png',
            'price' => 'required|integer|min:1',
        ];
    }
}
