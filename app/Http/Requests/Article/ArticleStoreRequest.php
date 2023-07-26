<?php

namespace App\Http\Requests\Article;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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

            'bike_id'    => 'integer|required',
            'article'    => 'string|required',
            'title'      => 'string|required',
            'price'      => [
                'nullable',
                'regex:/^[-+]?\d+(\.\d{1,2})?$/',
            ],
            'additional' => 'string|nullable',
        ];
    }
}
