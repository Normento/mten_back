<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('document_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable','string',Rule::unique('documents', 'name')->ignore($this->route('document'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:10240',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'category_document_id' => ['required', 'integer', 'exists:category_documents,id'],
            'status' => 'nullable|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'tag' => 'nullable|array',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
