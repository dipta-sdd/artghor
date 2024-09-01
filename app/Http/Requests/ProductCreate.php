<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreate extends FormRequest
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
            [
                'name' => 'required|string|max:255|unique:products',
                'description' => 'nullable|string|max:2000',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|numeric',
                'subcategory_id' => 'required|numeric',
            ]
        ];
    }
}
