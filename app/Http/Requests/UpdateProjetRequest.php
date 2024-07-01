<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProjetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('projet_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable','string',Rule::unique('projets', 'title')->ignore($this->route('projet'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'category_projet_id' => ['nullable', 'integer', 'exists:category_projets,id'],
            'status' => 'nullable|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'tag' => 'array|nullable',
            'start_date' => 'nullable|date', 
            'end_date' => 'nullable|date', 
            'type' => 'nullable|string|in:document,text',
            'file' => 'nullable|mimes:pdf|max:10240',
            'author' => 'string|nullable', 

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
