<?php

namespace App\Http\Requests\Payment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'type_id' => ['integer', 'required'],
            'title' => ['string', 'required'],
            'mileage' => ['integer', 'nullable'],
            'payment_date' => ['date', 'nullable'],
            'price' => [
                'required',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'additional' => ['string', 'nullable'],
        ];
    }
}
