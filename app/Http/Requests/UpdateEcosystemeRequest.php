<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateEcosystemeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('ecosysteme_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable','string',Rule::unique('ecosystemes', 'title')->ignore($this->route('ecosysteme'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'tag' => 'nullable|array',
            'category_ecosysteme_id' => ['nullable', 'integer', 'exists:category_ecosystemes,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
