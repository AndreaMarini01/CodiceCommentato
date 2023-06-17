<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class faqController extends Controller
{

    public function faq(){
        $faq=DB::select("select * from faq");
        return view('CRUDFaq/faq', ['faq'=>$faq]);
    }


    public function faqCreate(Request $request){

        $domanda = $request->input('domanda');
        $risposta = $request->input('risposta');
        //i values da inserire sono [$domanda, $risposta]
        DB::insert('insert into faq (domanda, risposta) values (?, ?)', [$domanda, $risposta]);
        return redirect()->route('faq');

    }

    //Serve per passare l'opzione giusta alla vista faqDesigner
    //e quindi restituire la vista per la creazione o per la modifica
    public function faqedit(Request $request){
        if($request->id=='create'){
            return view('CRUDFaq/faqDesigner', ['option'=>'create']);

        }
        else{
            $option = 'edit';
            //i singoli apici servono per trattare $request->id come una stringa
            //il punto all'inizio ed alla fine di $request->id servono per la concatenazione di stringhe
            $query="select * from faq where id='".$request->id."'";
            $faq=DB::select($query);

            return view('CRUDFaq/faqDesigner', ['option'=>$option], ['faq'=>$faq]);
        }

    }


    public function savefaq(Request $request){

        $domanda = $request->input('domanda');
        $risposta = $request->input('risposta');

        DB::Table('faq')
            ->where('id', $request->id)
            ->update(['domanda'=>$domanda, 'risposta'=>$risposta]);

        return redirect()->route('faq');
    }

    public function faqdelete(Request $request) {
        DB::delete('delete from faq where id = ?',[$request->id]);
        return redirect()->route('faq');
    }


}
