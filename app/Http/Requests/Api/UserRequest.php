<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'name'=>'required|regex:/^[a-zA-ZÀ-úçÇ\s]+$/u|min:5|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];
        
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'sometimes|email|unique:users,email,' . Auth::id();
            $rules['password'] = 'sometimes';
            $rules['photo'] = 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:1024';
        }

        return $rules;
    }

    public function messages() : array 
    {
        return[
            'name.required'=>'É obrigatório fornecer um nome',
            'name.regex'=>'Só é permitido usar nome com letras',
            'name.min'=>'O nome deve conter no mínimo :min letras',
            'name.max'=>'O nome deve conter no máximo :max letras',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de email válido.',
            'email.unique' => 'O email que digitou já está registado.',
            'password.required' => 'O campo palavra-passe é obrigatório.',
            'password.min' => 'A palavra-passe deve ter pelo menos 6 caracteres.',

            'photo.image' => 'So pode carregar uma imagem',
            'photo.mimes' => 'A imagem só pode ser peg,png,jpg,gif',
            'photo.max' => 'O tamanho máximo da imagem deve ser de 1MB',
        ];
    }
}
