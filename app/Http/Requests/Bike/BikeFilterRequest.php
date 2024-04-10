<?php

namespace App\Http\Requests\Bike;

use Illuminate\Foundation\Http\FormRequest;

class BikeFilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'mark' => ['nullable', 'integer'],
            'vin'  => ['nullable', 'string'],
            'year' => ['nullable', 'integer'],
        ];
    }
}
