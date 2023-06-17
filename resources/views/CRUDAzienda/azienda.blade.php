<!DOCTYPE html>
<!--
 l'annotazione include di blade serve per include nella vista corrente una sottovista già esistente
 l'annotazione extends di blade esprime il layout di partenza per la vista
 l'annotazione section di blade definisce una sezione del documento
 l'annotazione yield di blade mostra una sezione che viene definita altrove
 l'annotazione csrf di blade serve prendere le informazioni dalle form in modo sicuro
 l'annotazione can di blade serve per attivare un gate in una vista
 -->

<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDAzienda\infoAzienda.css') }}">
@endsection

@section('content')
    @if(!empty($info))
        @foreach($info as $azienda)
            <div class="titolo_azienda">
                <br><br>
                <h1>{{$azienda->nomeAzienda}}</h1>
            </div>
            <br>
            <div class="immagine_azienda">
                <center>
                    <img src={{URL('images/'.$azienda->logo)}} height="300"width="300">
                    <br>
                </center>
            </div>
            <div class="caratteristiche_azienda">
                <center>
                    <br>
                    <li>{{$azienda->localizzazione}}, {{$azienda->tipologia}}, {{$azienda->ragioneSociale}}</li>
                </center>
            </div>
            <br>
            <section>
                <center>
                    <div class="descrizione_azienda">
                        {{$azienda->descrizioneAzienda}}
                    </div>
                </center>
            </section>
        @endforeach
    @endif
    <center><div class="bottone_indietro"><button  onclick="location.href='{{route('listaAziende')}}';">Indietro</button> </div></center>

@endsection
</html>
