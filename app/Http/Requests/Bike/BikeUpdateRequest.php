<?php

namespace App\Http\Requests\Bike;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BikeUpdateRequest extends FormRequest
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

            'mark_id' => ['integer', 'nullable', 'exists:moto_marks,mark_id'],
            'model' => ['string', 'nullable'],
            'year' => ['integer', 'nullable'],
            'volume' => ['integer', 'nullable'],
            'vin' => ['string', 'nullable'],
            'number' => ['string', 'nullable'],
            'additional' => ['string', 'nullable'],
        ];
    }
}
