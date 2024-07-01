<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateReformeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('reforme_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable','string',Rule::unique('reformes', 'title')->ignore($this->route('reforme'))],
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
            'file' => 'nullable|mimes:pdf|max:10240',
            'status' => 'nullable|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'tag' => 'nullable|array',
            'type' => 'nullable|string|in:document,text',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
