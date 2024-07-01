<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEtatDesLieuxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('etatDesLieux_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'published_at' => 'nullable|string|date',
            'type' => 'nullable|string|in:document,text',
            'author' => 'nullable|string|',
            'description' => 'nullable|string',
            'content' => 'nullable|string|max:200',
            'title' => ['nullable','string',Rule::unique('etats_des_lieux', 'title')->ignore($this->route('etats_des_lieux'))],
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'file' => 'nullable|mimes:pdf|max:10240',
            'status' => 'nullable|string|in:isPublished,isDraft,isPlanned,isUpdated',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
