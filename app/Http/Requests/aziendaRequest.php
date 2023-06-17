<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class aziendaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(){
        //Serve per prendere l'id dell'azienda di cui si stanno validando i campi
        $azienda_id = $this->request->get('azienda_id');
        return[
            //Rule::unique serve per definire l'unicità di una colonna
            //ignore serve per ignorare la colonna indicata durante il controllo
            'nomeAzienda'=>['required', 'string',
                Rule::unique('aziendas', 'nomeAzienda')->ignore($azienda_id, 'idAzienda')],
            'localizzazione'=>'required',
            'tipologia'=>'required',
            'descrizioneAzienda'=>'required',
            'ragioneSociale'=>'required'
        ];
    }

    public function messages (){
        return[
          'required' => 'il campo :attribute è necessario',
            'unique'=> "Questo valore è già occupato da un'altra azienda"
        ];
    }
}
