<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSalesRequest extends FormRequest
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
            'items_sold' => ['required', 'integer', 'min:1'], // Minimum 1 item sold
            'sales_amount' => ['required', 'numeric', 'min:0.01'], // Minimum sales amount of 0.01
            'state' => ['required', Rule::in([1, 3])],
            'store_id' => ['required', 'exists:stores,id'], // Ensure store exists
            'time_id' => ['required', 'exists:times,id'], // Ensure time record exists
            'product_id' => ['required', 'exists:products,id'], // Ensure product exists
        ];
    }
}
