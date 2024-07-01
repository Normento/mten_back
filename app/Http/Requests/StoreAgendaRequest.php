<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class StoreAgendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Gate::allows('agenda_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'title' => 'required|string', 
           'description' => 'nullable|string',
           'content' => 'nullable|string',
           'location' => 'required|string',
           'start_date' => 'required|date',
           'end_date' => 'required|date',
           'time' => 'nullable|string',
            'image' => 'required|mimes:png,jpg,webp,jpeg|max:2048',
            'ministre_id' => 'nullable|integer|exists:ministres,id',
           'category_agenda_id' => 'required|integer|exists:category_agendas,id',
           'status' => 'nullable|string|in:isPublished,isDraft,isPlanned,isUpdated',
           'type' => 'required|string|in:ministre,ministere',
            'tag' => 'nullable|array',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }
}
