<?php

namespace App\Http\Requests\Service;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
            'title' => ['string', 'nullable'],
            'work_list' => ['string', 'nullable'],
            'service_title' => ['string', 'nullable'],
            'mileage' => ['integer', 'nullable'],
            'service_date' => ['date', 'nullable'],
            'price' => [
                'nullable',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'status' => ['integer', 'nullable'],
            'additional' => ['string', 'nullable'],
        ];
    }
}
