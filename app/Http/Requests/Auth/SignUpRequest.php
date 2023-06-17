<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'username' => 'required|string|min:8|unique:App\Models\User,username',
            'password' => 'required|string|confirmed|min:8',
            'email'=> 'required|string|email|unique:App\Models\User,email',
            'nome' => 'required',
            'cognome'=>'required',
            'telefono'=>'required|min:8|max:10',
            'datadinascita'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'il campo :attribute è necessario',
            'username.min' => 'Il campo :attribute deve avere esattemente 8 caratteri',
            'password.min' => 'Il campo :attribute deve avere almeno 8 caratteri',
            'max'=> 'Il campo :attribute deve avere esattemente 10 caratteri',
            'telefono.min' => 'Numero di telefono non valido',
            'telefono.max' => 'Numero di telefono non valido',
            'email'=> 'E-mail non valida',
            'confirmed' => 'Le password inserite non coincidono',
            'unique'=> 'Questo valore è già occupato da un altro utente'
        ];
    }
}
