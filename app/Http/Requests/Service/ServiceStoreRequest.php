<?php

namespace App\Http\Requests\Service;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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

            'bike_id'       => 'integer|required',
            'title'         => 'string|required',
            'work_list'     => 'string|nullable',
            'service_title' => 'string|nullable',
            'mileage'       => 'integer|nullable',
            'price'         => [
                'nullable',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'status'        => 'integer|required',
            'additional'    => 'string|nullable',
        ];
    }
}
