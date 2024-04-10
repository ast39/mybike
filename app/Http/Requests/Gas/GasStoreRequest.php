<?php

namespace App\Http\Requests\Gas;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GasStoreRequest extends FormRequest
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

            'bike_id' => ['integer', 'required', 'exists:bikes,bike_id'],
            'gas_station' => ['string', 'nullable'],
            'mileage' => ['integer', 'required'],
            'gas_date' => ['date', 'nullable'],
            'volume' => [
                'required',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'price' => [
                'required',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'additional' => ['string', 'nullable'],
        ];
    }
}
