<?php

namespace App\Http\Requests\Gas;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GasUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'bike_id' => ['integer', 'nullable', 'exists:bikes,bike_id'],
            'gas_station' => ['string', 'nullable'],
            'mileage' => ['integer', 'nullable'],
            'gas_date' => ['date', 'nullable'],
            'volume' => [
                'nullable',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'price' => [
                'nullable',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'additional' => ['string', 'nullable'],
        ];
    }
}
