<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateOrganismeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('organisme_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [

            'title' => ['nullable','string',Rule::unique('organismes', 'title')->ignore($this->route('organisme'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'institution' => 'nullable|string',
            'dirigant' => 'nullable|string',
            'created_date' => 'nullable|date',
            'tag' => 'nullable|array',
            'file' => 'nullable|mimes:pdf|max:10240',
            'type' => 'nullable|string|in:document,text',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
