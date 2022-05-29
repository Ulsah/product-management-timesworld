<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        		'id' => ['nullable', 'numeric'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'color' => ['required', 'string'],
            'height' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'length' => ['required', 'numeric'],
            'image' => ['nullable', 'mimes:jpg,png,jpeg']
        ];
    }
}
