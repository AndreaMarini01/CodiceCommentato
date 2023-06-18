<?php

namespace App\Http\Controllers;

use App\Models\Azienda;
use App\Models\emissione_coupon;
use App\Models\Promozione;
use DateTime;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;

class filterController extends Controller
{

    public function filter(Request $request)
    {
        $filteredCoupons = [];
        $output = "";
        //$request->ricercaAzienda è il valore inserito nella casella di input dall'utente
        if ($request->ricercaAzienda != '' && $request->ricercaParola == '') {
            //join tra la tabella promozione e la tabella azienda
            //il join avviene medinate l'attributo idAzienda della prima tabella e idAzienda della seconda tabella
            // % rappresenta un numero indefinito di caratteri
            //like cerca una sottostringa con il valore inserito
            $filteredCoupons = DB::table('promozione')->join('aziendas', 'promozione.idAzienda', '=', 'aziendas.idAzienda')
                ->where('nomeAzienda', 'Like', '%' . $request->ricercaAzienda . '%')->get();
        }
        if ($request->ricercaParola != '' && $request->ricercaAzienda == '') {
            $filteredCoupons = DB::table('promozione')->join('aziendas', 'promozione.idAzienda', '=', 'aziendas.idAzienda')
                ->where('oggetto', 'Like', '%' . $request->ricercaParola . '%')->get();
        }
        if ($request->ricercaParola && $request->ricercaAzienda) {
            $filteredCouponsbyName = DB::table('promozione')->join('aziendas', 'promozione.idAzienda', '=', 'aziendas.idAzienda')
                ->where('nomeAzienda', 'Like', '%' . $request->ricercaAzienda . '%')->get();
            $filteredCouponsbyWords = DB::table('promozione')->join('aziendas', 'promozione.idAzienda', '=', 'aziendas.idAzienda')
                ->where('oggetto', 'Like', '%' . $request->ricercaParola . '%')->get();

            foreach ($filteredCouponsbyWords as $filteredCouponbyWords) {
                foreach ($filteredCouponsbyName as $filteredCouponbyName) {
                    if ($filteredCouponbyName->idPromozione == $filteredCouponbyWords->idPromozione) {
                        array_push($filteredCoupons, $filteredCouponbyName);
                    }
                }
            }
        }
        if (Auth::check()) {
            //Tutte le promozioni salvate dal singolo utente
            $promozioniSalvate = DB::table('emissione_coupon')->where('idUtente', Auth::user()->id)->get();
                foreach ($promozioniSalvate as $promo) {
                    for ($i=0;$i<=sizeof($filteredCoupons)-1; $i++) {
                        //se l'utente ha salvato una promozione, viene rimossa dal vettore
                        //A livello di vista, non viene mostrata la promozione nel catalogo
                        if ($filteredCoupons[$i]->idPromozione == $promo->idPromozione) {
                                unset($filteredCoupons[$i]);
                        }
                    }
                }
                foreach ($filteredCoupons as $coupon) {
                    //redirectToRoute() è implementanto in filtri.js
                    //Serve per inserire in ogni rettangolo di offerta il bottone di Salva e Visualizza Promozione
                    //e il corretto reindirizzamento alla pagina desiderata dopo il click
                    $output .=
                        '<div class="promozione">
                   <p>Nome Offerta: ' . $coupon->nomePromozione . '</p>
                   <p>Oggetto Offerta:' . $coupon->oggetto . '</p>
                   <p id="scontistica"> Scontistica:' . $coupon->scontistica . ' </p>
                    <p id="nomeAzienda"> Nome Azienda: ' . $coupon->nomeAzienda . ' </p>
                    <button class="bottoni2" onclick="redirectToRoute(\'' . route('visualPromozione', ['info' => $coupon->idPromozione]) . '\')">Visualizza</button>
                    <button class="salvaCoupon" onclick="redirectToRoute(\'' . route('salvaCoupon', ['idPromozione' => $coupon->idPromozione]) . '\')">Salva Coupon</button>
                    </div>';
                }
                return response($output);
        }
        //Uguale a sopra per un utente non loggato che quindi non può salvare il coupon
        foreach ($filteredCoupons as $coupon) {
                $output .=
                    '<div class="promozione">
                   <p>Nome Offerta: ' . $coupon->nomePromozione . '</p>
                   <p>Oggetto Offerta:' . $coupon->oggetto . '</p>
                   <p id="scontistica"> Scontistica:' . $coupon->scontistica . ' </p>
                    <p id="nomeAzienda"> Nome Azienda: ' . $coupon->nomeAzienda . ' </p>
                    <button class="bottoni2" onclick="redirectToRoute(\'' . route('visualPromozione', ['info' => $coupon->idPromozione]) . '\')">Visualizza</button>
                    </div>';

        }
        return response($output);
    }
}
