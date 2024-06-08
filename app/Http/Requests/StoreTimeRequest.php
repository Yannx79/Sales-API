<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTimeRequest extends FormRequest
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
        $monthDescriptionOptions = config('database.time.month_description');
        $weekDescriptionOptions = config('database.time.week_description');

        return [
            'date' => ['required', 'date', 'after_or_equal:today'], // Ensure date is today or after
            'month' => ['required', 'integer', 'between:1,12'], // Month between 1 and 12
            'month_description' => ['required', 'string', 'max:255', Rule::in($monthDescriptionOptions)],
            'year' => ['required', 'integer', 'min:1900'], // Minimum year set to 1900 (adjust as needed)
            'week' => ['required', 'integer', 'between:1,52'], // Week between 1 and 52
            'week_description' => ['required', 'string', 'max:255', Rule::in($weekDescriptionOptions)],
            'state' => ['required', Rule::in([1, 3])],
        ];
    }
}
