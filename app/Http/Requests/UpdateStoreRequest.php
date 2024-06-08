<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStoreRequest extends FormRequest
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
        $districtOptions = config('database.departments.lima');

        return [
            'description' => ['required', 'string', 'max:255'],
            'district' => [
                'required',
                'string',
                Rule::in($districtOptions),
            ],
            'state' => ['required', 'integer', Rule::in([1, 3])],
        ];
    }
}
