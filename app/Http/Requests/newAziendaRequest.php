<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class newAziendaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(){
        $azienda_id = $this->request->get('azienda_id');
        return[
            'nomeAzienda'=>['required','string',Rule::unique('aziendas', 'nomeAzienda')->ignore($azienda_id, 'idAzienda')],
            'localizzazione'=>'required',
            'tipologia'=>'required',
            'descrizioneAzienda'=>'required',
            'ragioneSociale'=>'required',
            'logo'=>'required'
        ];
    }

    public function messages (){
        return[
            'required' => 'il campo :attribute è necessario',
            'unique' => "Esiste già un'azienda con questo nome"
        ];
    }
}
