<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique('service_types', 'slug')->ignore($this->route('serviceType')),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:active,inactive'],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Service type name is required.',
            'slug.required' => 'Service type slug is required.',
            'slug.unique' => 'The slug has already been taken.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
