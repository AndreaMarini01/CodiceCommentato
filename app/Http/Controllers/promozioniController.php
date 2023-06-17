<?php

namespace App\Http\Controllers;

use App\Http\Requests\promozioneRequest;
use App\Models\Promozione;
use App\Models\emissione_coupon;
use DateTime;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class promozioniController extends Controller
{

    public function listaPromozioni()
    {
        $promozioni = DB::table('promozione')
            ->join('aziendas', 'promozione.idAzienda', '=', 'aziendas.idAzienda')
            ->select('promozione.*','aziendas.nomeAzienda as nomeAzienda')
            ->get();
        $listaPromozioni = [];
        foreach ($promozioni as $promozione) {
            //Converte la stringa a dataScadenza in DateTime
            $dataScadenza = new DateTime($promozione->dataScadenza);
            //Prende la data odierna sotto forma di stringa e la converte in DateTime
            $dataOdierna = new DateTime(date("Y-m-d"));

            if ($dataOdierna <= $dataScadenza) {
                array_push($listaPromozioni, $promozione);
            }
        }
        if (!Auth::check()) {
            return view('CRUDPromozioni/listaPromozioni', ['listaPromozioni' => $listaPromozioni]);
        } else if (Gate::allows('isUser')) {
            $couponSalvati = DB::Table('emissione_coupon')->where('idUtente', Auth::user()->id)->get();
            foreach ($couponSalvati as $coupon) {
                for ($i = 0; $i <= sizeof($listaPromozioni) - 1; $i++) {
                    if ($coupon->idPromozione == $listaPromozioni[$i]->idPromozione) {
                        //toglie dall'array listaPromozioni le promozioni già salvate
                        //elimina l'elemento $i da listaPromozioni
                        array_splice($listaPromozioni, $i, 1);
                    }

                }
            }
            return view('CRUDPromozioni/listaPromozioni', ['listaPromozioni'=>$listaPromozioni]);
        } else
            return view('CRUDPromozioni/listaPromozioni', ['listaPromozioni' => $listaPromozioni]);
    }



    public function modificaPromozione(Request $request){
        $promozione=DB::Table('promozione')
            ->where('idPromozione', $request->idPromozione)->get();
        $option= 'edit';
        return view('CRUDPromozioni/promozioneDesigner', ['promozione'=>$promozione], ['option'=>$option]);
    }


    public function promozioneCreator(){
        return view('CRUDPromozioni/promozioneDesigner', ['option'=>'create']);
    }

    public function visualPromozione(Request $request){
        //Il join è necessario perchè il nomeAzienda non è presenta nella tabella promozioni
        //e quindi deve essere preso dalla tabella Azienda tramite il join
        $info = DB::table('promozione')
            ->join('aziendas', 'promozione.idAzienda', '=', 'aziendas.idAzienda')
            ->where('promozione.idPromozione', $request->idPromozione)
            ->select('promozione.*','aziendas.nomeAzienda as nomeAzienda')
            ->get();
        return view('CRUDPromozioni/promozione',['info'=> $info]);
    }

    public function eliminaPromozione(Request $request){
        DB::delete('delete from promozione where idPromozione = ?',[$request->idPromozione]);
        return redirect(route('listaPromozioni'));
    }

    public function editPromozione(promozioneRequest $request)
    {

        $data['nomePromozione'] = $request->nomePromozione;
        $data['oggetto'] = $request->oggetto;
        $data['modalità'] = $request->modalità;
        $data['scontistica'] = $request->scontistica;
        $data['luogoFruizione'] = $request->luogoFruizione;
        $data['idAzienda'] = $request->idAzienda;
        $data['dataScadenza'] = $request->dataScadenza;;

        Promozione::where('idPromozione',$request->id)->update($data);
        return redirect(route('listaPromozioni'));
    }

    public function creaPromozione(promozioneRequest $request)
    {

        $data['nomePromozione'] = $request->nomePromozione;
        $data['oggetto'] = $request->oggetto;
        $data['modalità'] = $request->modalità;
        $data['scontistica'] = $request->scontistica;
        $data['luogoFruizione'] = $request->luogoFruizione;
        $data['idAzienda'] = $request->idAzienda;
        $data['dataScadenza'] = $request->dataScadenza;;
        Promozione::create($data);

        return redirect(route('listaPromozioni'));

    }

    public function salvaCoupon(Request $request){
        $data['idPromozione']=$request->idPromozione;
        $data['idUtente']=Auth::user()->id;
        $data['dataEmissione']=date('Y-m-d');
        //Stringa di caratteri
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        //Generazione di un codice casuale per il Coupon
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $data['codice']=$randomString;
        emissione_coupon::create($data);
        $listaId=DB::Table('emissione_coupon')
            ->where('idUtente', Auth::user()->id)->get();
        $Coupons=DB::Table('promozione')->where('idPromozione', $request->idPromozione)->get();
        $codice=null;
        //Istruzioni per prendere il codice del coupon
        foreach ($listaId as $coupon){
            if ($coupon->idPromozione==$request->idPromozione){
                $codice=$coupon->codice;
            }
        }
        return view('couponSalvati',['promozione'=>$Coupons],['codice'=>$codice]);
    }

    public function couponSalvati()
    {
        $listaId=DB::Table('emissione_coupon')
            ->where('idUtente', Auth::user()->id)->get();
        $tuttiCoupon=DB::Table('promozione')->get();
        $listaCoupon=[];
        $dataOdierna= new DateTime(date("Y-m-d"));
        $listaCodici=[];
        foreach ($listaId as $id){
            foreach ($tuttiCoupon as $coupon){
                $dataScadenza=new DateTime($coupon->dataScadenza);
                if($coupon->idPromozione==$id->idPromozione and $dataOdierna<=$dataScadenza){
                    array_push($listaCodici,$id->codice);
                    array_push($listaCoupon,$coupon);
                }
            }
        }
        return view('couponSalvati',['listaCoupon'=>$listaCoupon],['listaCodici'=>$listaCodici]);
    }

}
