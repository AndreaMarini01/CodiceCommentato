<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\couponSalvati.css') }}">
@endsection

@section('content')


    @if(isset($listaCoupon))
        @for($i=0;$i<=sizeof($listaCoupon)-1; $i++)
            <div class="header_coupon">
                <div class="nomeCoupon"><h1>Nome Coupon: {{$listaCoupon[$i]->nomePromozione}}</h1></div>
                <div class="scadenza"> Scadenza: {{$listaCoupon[$i]->dataScadenza}}</div>
            </div>
            <br><br>
            <div class="descrizione_offerta">
                <p>Descrizione dell'offerta: <br>
                    {{$listaCoupon[$i]->oggetto}}</p>
                <p class="usufruente"><b>Nome usufruente: {{Auth::user()->nome}} {{Auth::user()->cognome}}</b></p>
            </div>
            <div class="footer_coupon">
                <div class="scontistica">{{$listaCoupon[$i]->scontistica}}%</div>
                <div class="codice">
                    <p>Il tuo codice: {{$listaCodici[$i]}}</p>
                    <p>Modalità di fruizione: {{$listaCoupon[$i]->modalità}}</p>
                </div>
            </div>
            <br><br><br><br>
            <hr color="#4CAF50">
        @endfor
        <center>
            @if(sizeof($listaCoupon)==0)
            <br><br>
            @endif
            <div class="bottone_indietro"><button  onclick="location.href='{{route('profile')}}';">Indietro</button> </div></center>
    @endif



    @if(isset($promozione))

        @foreach($promozione as $promo)
            <div class="header_coupon">
                <div class="nomeCoupon"><h1>Nome Promozione: {{$promo->nomePromozione}}</h1></div>
                <div class="scadenza"> Scadenza: {{$promo->dataScadenza}}</div>
            </div>
            <br>
            <br>
            <div class="descrizione_offerta">
                <p>Descrizione della promozione: <br>
                    {{$promo->oggetto}}</p>
                <br>
                <p class="usufruente">Nome usufruente: {{Auth::user()->nome}} {{Auth::user()->cognome}}</p>
            </div>
            <div class="footer_coupon">
                <div class="scontistica">{{$promo->scontistica}}%</div>
                <div class="codice">
                    <p>Il tuo codice: {{$codice}}</p>
                    <p>Modalità di fruizione: {{$promo->modalità}}</p>
                </div>
            </div>
            <br><br><br><br>
            <hr color="#4CAF50">
        @endforeach
        <center>
            @if(sizeof($promozione)==0)
                <br><br>
            @endif
            <div class="bottone_indietro"><button  onclick="location.href='{{route('listaPromozioni')}}';">Indietro</button> </div></center>



    @endif



<br><br>
@endsection

</html>
