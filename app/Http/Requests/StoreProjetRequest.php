<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class StoreProjetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('projet_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:projets,title',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'category_projet_id' => ['required','integer','exists:category_projets,id'],
            'status' => 'required|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'tag' => 'array|required', 
            'start_date' => 'nullable|date', 
            'type' => 'required|string|in:document,text',
            'file' => 'nullable|mimes:pdf|max:10240',
            'end_date' => 'nullable|date', 
            'author' => 'string|required', 

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
