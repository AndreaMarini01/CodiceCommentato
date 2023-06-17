<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDPromozioni\promozione.css') }}">
@endsection

@section('content')

    @if(!empty($info))
        @foreach($info as $promozione)
            <br><br><br>
            <title>Visualizza Promozione {{$promozione->nomePromozione}}</title>
            <table>
                <tr>
                    <th>Nome Offerta:</th>
                    <td> {{$promozione->nomePromozione}}</td>
                </tr>
                <tr>
                    <th>Azienda:</th>
                    <td> {{$promozione->nomeAzienda}}</td>
                </tr>
                <tr>
                    <th>Descrizione offerta:</th>
                    <td> {{$promozione->oggetto}}</td>
                </tr>
                <tr>
                    <th>Modalità offerta:</th>
                    <td> {{$promozione->modalità}}</td>
                </tr>
                <tr>
                    <th>Sconto:</th>
                    <td> {{$promozione->scontistica}}%</td>
                </tr>
                <tr>
                    <th>Usufruibile presso:</th>
                    <td> {{$promozione->luogoFruizione}}</td>
                </tr>
                <tr>
                    <th>Nel periodo:</th>
                    <td> {{$promozione->dataScadenza}}</td>
                </tr>
            </table>
        @endforeach
    @endif
    <center><div class="bottone_indietro"><button  onclick="location.href='{{route('listaPromozioni')}}';">Indietro</button> </div></center>

@endsection
</html>
