<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TshirtImageRequest extends FormRequest
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
            ],
            'description' => [
                'required',
            ],
            'photo_file' =>         'sometimes|image|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>    'O nome é obrigatório',
            'name.unique' =>      'O nome tem que ser único',
            'description.required' =>   'O email é obrigatório',
            'photo_file.image' => 'O ficheiro com a foto não é uma imagem',
            'photo_file.size' => 'O tamanho do ficheiro com a foto tem que ser inferior a 4 Mb',
        ];
    }
}