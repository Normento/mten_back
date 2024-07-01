<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class StoreOpportuniteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('opportunity_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:opportunites,title',
            'description' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|string|in:isOpenned,isClosed',
            'structure_acceuil' => 'required|string',
            'file' => 'required|mimes:pdf|max:10240',
            'category_opportunity_id' => ['required','integer','exists:category_opportunities,id'],
            'tag' => 'array|required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
