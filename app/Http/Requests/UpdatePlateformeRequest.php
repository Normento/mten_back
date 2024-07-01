<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlateformeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('plateforme_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable','string',Rule::unique('plateformes', 'name')->ignore($this->route('plateforme'))],
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'logo' => 'nullable|mimes:png,jpg,webp,jpeg|max:2048',
        ];
    }
}
