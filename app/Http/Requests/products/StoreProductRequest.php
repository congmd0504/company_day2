<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier'      => 'required',
            'name'          => 'required',
            'stock'         => 'required|numeric|min:1',
            'sold'          => 'required|numeric|min:1',
            'price'         => 'required|numeric|min:1',
            'discount'      => 'required|numeric|min:1|max:100',
            'user_id'       =>'required',
        ];
    }
}
