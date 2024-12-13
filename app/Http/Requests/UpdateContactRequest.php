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
        return true;
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
            'contact' => 'sometimes|required|digits:9|unique:contacts,contact,' . $this->route('contact'),
            'email' => 'sometimes|required|email|unique:contacts,email,' . $this->route('contact'),
        ];
    }


    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser uma string.',
            'name.min' => 'O campo Nome deve ter pelo menos 5 caracteres.',
            'contact.required' => 'O campo Contacto é obrigatório.',
            'contact.digits' => 'O campo Contacto deve ter 9 dígitos.',
            'contact.unique' => 'Este número de contacto já está cadastrado.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'O campo Email deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
        ];
    }
}
