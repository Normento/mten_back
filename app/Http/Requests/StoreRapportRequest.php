<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRapportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('rapport_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:rapports,title',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'file' => 'nullable|mimes:pdf|max:10240',
            'category_rapport_id' => ['required', 'integer', 'exists:category_rapports,id'],
            'status' => 'required|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'tag' => 'array|required',
            'secteur_activite' => 'string|nullable',
            'type_activite' => 'string|nullable',
            'institution' => 'string|nullable',
            'start_date' => 'string|nullable|date',
            'type' => 'required|string|in:document,text',
            'end_date' => 'string|nullable|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
