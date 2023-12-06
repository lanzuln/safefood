<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required',
            'image' => 'required',
            'real_price' => 'required',
            'sale_price' => 'required',
            'qty' => 'required',
            'weight' => 'nullable',
            'u_code' => 'required|unique:products,u_code',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ];
    }
}
