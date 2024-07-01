<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateActeurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('acteur_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'url' => 'nullable|url|string',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1920,max_height=1080',
            'sigle' => ['nullable','string',Rule::unique('acteurs', 'sigle')->ignore($this->route('acteur'))]    ,
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'dirigant' => 'nullable|string',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
