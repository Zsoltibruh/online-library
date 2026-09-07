<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'publication_year' => ['string', 'min_digits:4', 'required'],
            'count' => ['numeric', 'max:99', 'required'],
            'author_ids' => ['array', 'min:1', 'required'],
            'author_ids.*' => ['exists:authors,id'],
        ];
    }
}
