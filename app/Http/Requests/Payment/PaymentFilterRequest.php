<?php

namespace App\Http\Requests\Payment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentFilterRequest extends FormRequest
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

            'period_from' => ['nullable', 'date'],
            'period_to' => ['nullable', 'date'],
            'bike' => ['nullable', 'integer'],
            'type' => ['nullable', 'integer'],
        ];
    }
}
