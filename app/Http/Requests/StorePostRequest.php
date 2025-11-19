<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;  // minden felhasználó engedélyezve van a kéréshez
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:2',
            'body' => 'required|string|min:2',
            //'tags' => 'array',
            //'tags.*' => 'string|min:2'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must be less than :max characters',
            'title.min' => 'Title must be at least :min characters',
            'body.required' => 'Body is required',
            'body.string' => 'Body must be a string',
            'body.min' => 'Body must be at least :min characters',
        ];
    }
}
