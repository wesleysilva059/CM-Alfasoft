<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|min:5',
            'phone' => 'sometimes|required|digits:9|unique:contacts,phone,' . $this->route('contact'),
            'email' => 'sometimes|required|email|unique:contacts,email,' . $this->route('contact')
        ];
    }
}
