<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class UpdateBiographieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('biography_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'title' => 'required|string',
            'biography' => 'required|string',
            'facebook_url' => 'nullable|string|url',
            'linkedin_url' => 'nullable|string|url',
            'twitter_url' => 'nullable|string|url',
            'instagram_url' => 'nullable|string|url',
            'status' => 'required|string|in:isPublished,isDraft,isPlanned,isUpdated',
            'image' => 'required|mimes:png,jpg,webp,jpeg|max:2048',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
