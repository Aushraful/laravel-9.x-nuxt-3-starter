<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'en.name' => 'required|string',
            'en.slug' => 'required|string|unique:category_translations,slug',
            'en.description' => 'sometimes|string',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'string';
            $rules[$locale . '.slug'] = 'string';
            $rules[$locale . '.description'] = 'string';
        }

        return $rules;
    }
}
