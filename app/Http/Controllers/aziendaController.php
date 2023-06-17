<?php



namespace App\Http\Controllers;

use App\Http\Requests\aziendaRequest;
use App\Http\Requests\newAziendaRequest;
use App\Models\Azienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;


class aziendaController extends Controller
{
    //Restituisce una lista contenente tutte le aziende registrate
    public function listaAziende(){
        //Interfacciamento php e dbms: Raw SQL
        $aziende=DB::select('select * from aziendas');
        //Ritorna la vista contenente la lista di tutte le aziende
        //Passo alla vista la variabile listaAziende, inizializzata con la variabile
        //$aziende sopra definita
        return view('CRUDAzienda/listaAziende', ['listaAziende'=>$aziende]);
    }

    //Questa funzione ha come parametro una Request, il cui valore si può prendere dalla vista
    //corrispondente, in questo caso listaAziende
    //Questa funzione restituisce la vista da cui poi si potranno modificare i dati, grazie alla funzione
    //editAzienda
    public function modificaAzienda(Request $request){
        //Query Builder
        $azienda=DB::Table('aziendas')
            ->where('idAzienda', $request->idAzienda)->get();
        $option= 'edit';
        return view('CRUDAzienda/aziendaDesigner', ['azienda'=>$azienda], ['option'=>$option]);
    }


    public function aziendaCreator(){
        return view('CRUDAzienda/aziendaDesigner', ['option'=>'create']);
    }

    //Visualizzazione Azienda Singola
    public function visualAzienda(Request $request){
        //il valore di $request->idAzienda viene passato al controller dalla vista listaAzienda,
        //quando l'utente clicca sul bottone 'Visualizza Azienda'
        $info=DB::Table('aziendas')
            ->where('idAzienda', $request->idAzienda)->get();
        return view('CRUDAzienda/azienda',['info'=> $info]);
    }

    public function eliminaAzienda(Request $request){
        //Eloquent ORM
        $logo= Azienda::where('idAzienda',$request->idAzienda)->select('logo')->get();
        //Raw SQL
        //il ? presente nella query significa che il valore deve essere ancora passato alla variabile
        //il suo valore viene preso da $request->idAzienda
        DB::delete('delete from aziendas where idAzienda = ?',[$request->idAzienda]);
        unlink('images/'.$logo[0]->logo);
        return redirect(route('listaAziende'));
    }

    //aziendaRequest è un'estensione della classe FormRequest, in cui si possono definire
    //delle regole di validazione e dei messaggi di errore nel caso in cui queste regole
    //non vengano rispettate
    public function editAzienda(aziendaRequest $request)
    {   //$data è un array con i valori presi dai campi compilati dall'utente nella form nella vista
        //aziendaDesigner
        $data['idAzienda'] = $request->idAzienda;
        $data['ragioneSociale'] = $request->ragioneSociale;
        $data['nomeAzienda'] = $request->nomeAzienda;
        $data['localizzazione'] = $request->localizzazione;
        $logo= Azienda::where('idAzienda',$data['idAzienda'])->select('logo')->get();

        if ($request->logo){
            //il nome del logo è: valore_funzione_time().estensione_del_file
            $logoName = time().'.'.$request->logo->extension();
            $data['logo'] = $logoName;
            //la funzione move permette direttamente di aggiungere un file del file system
            //direttamente alla cartella public/images di laravel
            $request->logo->move(public_path('images'), $logoName);
            //la funzione unlink serve per eliminare il logo precedente
            unlink('images/'.$logo[0]->logo);
        } else{
            //se non cambio il logo rimane quello precedente
            $data['logo']=$logo[0]->logo;
        }

        $data['tipologia'] = $request->tipologia;
        $data['descrizioneAzienda'] = $request->descrizioneAzienda;

        Azienda::where('idAzienda',$data['idAzienda'])->update($data);


        return redirect(route('listaAziende'));
    }

    public function creaAzienda(newAziendaRequest $request)
    {
        $logoName = time().'.'.$request->logo->extension();
        $data['ragioneSociale'] = $request->ragioneSociale;
        $data['localizzazione'] = $request->localizzazione;
        $data['nomeAzienda'] = $request->nomeAzienda;
        $data['logo'] = $logoName;
        $data['tipologia'] = $request->tipologia;
        $data['descrizioneAzienda'] = $request->descrizioneAzienda;
        Azienda::create($data);

        $request->logo->move(public_path('images'), $logoName);

        return redirect(route('listaAziende'));
    }

}
