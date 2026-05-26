<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoBadWordsRule;

class StoreArticleRequest extends FormRequest
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
        'title' => [
            'required',
            'string',
            'min:10',
            'max:255',

            function ($attribute, $value, $fail) {

              if (strtolower($value) === 'test') {

                $fail('Invalid article title.');
             }
           }
        ],

        'content' => [
            'required',
            'string',
            'min:100',
             new NoBadWordsRule()
        ],

        'status' => [
            'required',
            'in:draft,published,archived'
        ],

         'tags' => [
            'nullable',
            'array'
        ],

        'tags.*' => [
            'exists:tags,id'
        ]

        ];
    }

    protected function prepareForValidation(): void
   {
    $this->merge([
        'title' => trim($this->title),
        'content' => trim($this->content),
    ]);
   }
}

