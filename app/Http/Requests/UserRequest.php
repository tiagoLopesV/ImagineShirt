<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('users', 'name')->ignore($this->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'blocked' =>            'required|boolean',
            'type' =>               'required|in:A,E',
            'photo_file' =>         'sometimes|image|max:4096',
            'password_inicial' =>   'sometimes|required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>    'O nome é obrigatório',
            'name.unique' =>      'O nome tem que ser único',
            'email.required' =>   'O email é obrigatório',
            'email.email' =>      'O formato do email é inválido',
            'email.unique' =>     'O email tem que ser único',
            'blocked.required' => 'O campo "admin" é obrigatório',
            'blocked.boolean' =>  'O campo "admin" tem que ser um booleano',
            'type.required' =>    'O campo "tipo" é obrigatório',
            'photo_file.image' => 'O ficheiro com a foto não é uma imagem',
            'photo_file.size' => 'O tamanho do ficheiro com a foto tem que ser inferior a 4 Mb',
            'password_inicial.required' => 'A password inicial é obrigatória',
        ];
    }
}