<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class StoreActeurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
       return Gate::allows('acteur_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'url' => 'nullable|url|string',
            'sigle' => 'required|string|unique:acteurs,sigle',
            'image' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1920,max_height=1080',
            'description' => 'nullable|string',
            'content' => 'nullable|string', 
            'dirigant' => 'required|string',  

        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
