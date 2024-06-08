<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $categoryOptions = config('database.products.category');

        return [
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', Rule::in($categoryOptions)],
            'state' => ['required', 'integer', Rule::in([1, 3])],
            'description_category' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
