<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class StoreStartupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('startup_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:startups,name',
            'description' => 'required|string',
            'content' => 'required|string',
            'promoteur' => 'required|string',
            'created_date' => 'nullable|date',
            'image' => 'required|mimes:png,jpg,webp,jpeg|max:2048',
            'category_startup_id' => ['required', 'integer', 'exists:category_startups,id'],
            'tag' => 'array|required',
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
