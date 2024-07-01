<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateOpportuniteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('opportunity_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable','string',Rule::unique('opportunites', 'title')->ignore($this->route('opportunite'))],
            'description' => 'nullable',
            'content' => 'nullable',
            'structure_acceuil' => 'nullable|string',
            'status' => 'nullable|string|in:isOpenned,isClosed',
            'file' => 'nullable|mimes:pdf|max:10240',
            'category_opportunity_id' => ['nullable','integer','exists:category_opportunities,id'],
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
