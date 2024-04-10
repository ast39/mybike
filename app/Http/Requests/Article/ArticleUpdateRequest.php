<?php

namespace App\Http\Requests\Article;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'article' => ['string', 'nullable'],
            'title' => ['string', 'nullable'],
            'price' => [
                'nullable',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'additional' => ['string', 'nullable'],
        ];
    }
}
