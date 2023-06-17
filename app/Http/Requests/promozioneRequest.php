<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Faker\Core\DateTime;
use Illuminate\Foundation\Http\FormRequest;

class promozioneRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return[
            'nomePromozione'=>'required',
            'oggetto'=>'required',
            'modalità'=>'required',
            'luogoFruizione'=>'required',
            'dataScadenza'=>'required',
            'idAzienda' =>'required',
            'scontistica'=>'required|integer|min:1|max:100'

        ];
    }

    public function messages (){
        return[
            'required'=>'il campo :attribute è necessario',
            'integer'=>'il valore inserito deve essere un numero',
            'min'=>'inserire un valore tra 1 e 100',
            'max'=>'inserire un valore tra 1 e 100'
        ];
    }
}
