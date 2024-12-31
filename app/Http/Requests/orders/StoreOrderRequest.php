<?php

namespace App\Http\Requests\orders;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name_user'     =>'required',
            'phone_number'  =>'required|numeric|min:9',
            'user_id'       =>'required',
            'total'         =>'required',
        ];
    }
}
