<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'  => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^\d{10,11}$/'],
            'email' => ['required', 'string', 'email'],
            'cep'   => ['required', 'string', 'regex:/^\d{8}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'O nome é obrigatório.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.regex'    => 'O telefone deve conter entre 10 e 11 dígitos numéricos.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'O e-mail deve estar em um formato válido.',
            'cep.required'   => 'O CEP é obrigatório.',
            'cep.regex'      => 'O CEP deve conter exatamente 8 dígitos numéricos.',
        ];
    }
}
