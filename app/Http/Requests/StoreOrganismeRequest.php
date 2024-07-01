<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrganismeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('organisme_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title' => 'required|string|',
            'description' => 'required|string',
            'content' => 'required|string',
            'institution' => 'required|string',
            'dirigant' => 'required|string',
            'created_date' => 'nullable|date',
            'tag' => 'required|array',
            'type' => 'required|string|in:document,text',
            'file' => 'nullable|mimes:pdf|max:10240',
            'image' => 'required|mimes:png,jpg,webp,jpeg|max:2048',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
