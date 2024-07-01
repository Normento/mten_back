<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateActualiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('actualite_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable','string',Rule::unique('actualites', 'title')->ignore($this->route('actualite'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'category_actualite_id' => ['nullable','integer','exists:category_actualites,id'],
            'status' => 'nullable|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'tag' => 'array|nullable',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
