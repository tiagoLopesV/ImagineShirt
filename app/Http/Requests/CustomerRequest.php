<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'nif' =>                'required|nullable|digits:9',
            'address' =>            'required|string',
            'payType' =>            'sometimes|in:MC,VISA,PAYPAL',
            'payRef' =>             'sometimes|string',
            'photo_file' =>         'sometimes|image|max:4096', // maxsize = 4Mb
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>  'O nome é obrigatório',
            'name.unique' =>    'O nome tem que ser único',
            'email.required' => 'O email é obrigatório',
            'email.email' =>    'O formato do email é inválido',
            'email.unique' =>   'O email tem que ser único',
            'blocked.required' => 'O campo "admin" é obrigatório',
            'blocked.boolean' =>  'O campo "admin" tem que ser um booleano',
            'nif.required' =>    'O nº de nif é obrigatório',
            'nif.digits' =>      'O nº de NIF deve ter exatamente 9 dígitos.',
            'photo_file.image' => 'O ficheiro com a foto não é uma imagem',
            'photo_file.size' => 'O tamanho do ficheiro com a foto tem que ser inferior a 4 Mb',
            'password_inicial.required' => 'A password inicial é obrigatória',
        ];
    }
}