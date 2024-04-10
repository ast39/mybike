<?php

namespace App\Http\Requests\Note;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NoteStoreRequest extends FormRequest
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
            'title' => ['string', 'required'],
            'note_date' => ['date', 'nullable'],
            'additional' => ['string', 'required'],
            'mileage' => ['integer', 'nullable'],
        ];
    }
}
