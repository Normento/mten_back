<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class StoreActualiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return  Gate::allows('actualite_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:actualites,title',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg|max:2048',
            'category_actualite_id' => ['required','integer','exists:category_actualites,id'],
            'status' => 'required|string|in:isPublished,isDraft,isPlanned,isUpdated',
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
