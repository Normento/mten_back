<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateStartupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('startup_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable','string',Rule::unique('startups', 'name')->ignore($this->route('startup'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'promoteur' => 'nullable|string',
            'created_date' => 'nullable|date',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'category_startup_id' => ['nullable', 'integer', 'exists:category_startups,id'],
            'tag' => 'array|nullable',
            'url' => 'nullable|string|url',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
