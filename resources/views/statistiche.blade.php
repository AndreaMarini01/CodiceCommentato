<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\statistiche.css') }}">
@endsection
<script src=""></script>
@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/statistiche.js')}}"></script>

    <div class="invisibile">{{$listaPromozioni=$lista['listaPromozioni']}}
        {{$listaUtenti=$lista['listaUtenti']}}}
        {{$listaCoupon=$lista['listaCoupon']}}</div>

    <div class="Titolo" style="margin-top:0px"><h1>Statistiche</h1></div>
    <div class="numeroCoupon">Numero totale di coupon emessi: {{sizeof($listaCoupon)}}</div>
    <hr>
    <div class="tipoStatistica">Seleziona il coupon di cui vuoi sapere le informazioni: </div>
    @for($i=0;$i<=sizeof($listaPromozioni)-1;$i++)
        <div class="promozione" id="promozione{{$i}}">
            <div><p id="idCoupon"> Nome offerta: {{$listaPromozioni[$i]->nomePromozione}} </p></div>
            <div><p id="oggetto"> Oggetto offerta: {{$listaPromozioni[$i]->oggetto}} </p></div>
            <button class="statsButton" id="visualInfoPromozione{{$i}}">Visualizza Info</button>
        </div>
        <div class="retropromozione" id="retropromozione{{$i}}">
            <div class="invisibile"> {{$counter=0}}
                @foreach($listaCoupon as $coupon)
                    @if($coupon->idPromozione==$listaPromozioni[$i]->idPromozione)
                        {{$counter++}}
                    @endif
                @endforeach</div>
            <p>Numero totale di coupon emessi: {{$counter}}</p>
            <button class="statsButton" id="retro_promozione_button{{$i}}">Indietro</button>
        </div>
    @endfor
    <hr>
    <div class="tipoStatistica">Seleziona l'utente di cui vuoi sapere le informazioni: </div>
    @for($j=0;$j<=sizeof($listaUtenti)-1;$j++)
        <div class="invisibile">{{$counter=0}}</div>
        <div class="utente" id="utente{{$j}}" >
            <div><p id="username"> Nome utente: {{$listaUtenti[$j]->username}} </p></div>
            <div><p id="email"> Email: {{$listaUtenti[$j]->email}} </p></div>
            <button class="statsButton" id="visualInfoUtente{{$j}}">Visualizza Info</button>
        </div>
        <div class="retroutente" id="retroutente{{$j}}">
            <div class="invisibile">
                @foreach($listaCoupon as $coupon)
                    @if($coupon->idUtente==$listaUtenti[$j]->id)
                        {{$counter++}}
                    @endif
                @endforeach</div>
            <p>Numero totale di coupon salvati: {{$counter}}</p>
            <button class="statsButton" id="retro_utente_button{{$j}}">Indietro</button>
        </div>

    @endfor
    <br><br><br><br><br><br>



@endsection
</html>
