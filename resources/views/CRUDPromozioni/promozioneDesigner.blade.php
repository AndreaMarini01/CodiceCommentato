<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDPromozioni\promozioneEditor.css') }}">
@endsection

@section('content')
    <?php $info = \App\Models\Azienda::all(); ?>
    @if(sizeof($info)==0)
        <center>
        <p class="noAziende">Non ci sono registrate aziende nel sito</p>
        <div class="bottone_indietro"><button  onclick="location.href='{{route('listaPromozioni')}}';">Indietro</button> </div></center>
    @else
        @if($option == 'edit')
            <h2>Modifica Promozione</h2>

        @endif
        @if($option == 'create')
            <h2>Crea nuova promozione</h2>
        @endif

    <center>

        @if(isset($promozione))
            @foreach($promozione as $promo)

                <center>
                    <form method="POST" class="form">
                        @csrf
                        <h2>Modifica i dati della promozione:</h2>
                        <label for="nomePromozione">Nome Coupon:</label>
                        @include('components.completeForm', ['parameter' => 'nomePromozione', 'complete'=>1, 'type'=>'text', 'page' => 'promozioneDesigner'])
                        <label for="oggetto">Oggetto:</label>
                        @include('components.completeForm', ['parameter' => 'oggetto', 'complete'=>1, 'type'=>'text', 'page' => 'promozioneDesigner'])
                        <label for="modalità">Modalità:</label>
                        @include('components.completeForm', ['parameter' => 'modalità', 'complete'=>1, 'type'=>'text', 'page' => 'promozioneDesigner'])
                        <label for="scontistica">Scontistica:</label>
                        @include('components.completeForm', ['parameter' => 'scontistica', 'complete'=>1, 'type'=>'text', 'page' => 'promozioneDesigner'])
                        <label for="luogoFruizione">Luogo Fruizione:</label>
                        @include('components.completeForm', ['parameter' => 'luogoFruizione', 'complete'=>1, 'type'=>'text', 'page' => 'promozioneDesigner'])
                        <label>Azienda:</label>
                        <select id="idAzienda" name="idAzienda">
                            @for($i=0;$i<=sizeof($info)-1;$i++)
                                <option value="{{$info[$i]['idAzienda']}}">{{$info[$i]['nomeAzienda']}}</option>
                            @endfor
                        </select>
                        <br><br>
                        <label for="dataScadenza">Data di scadenza:</label>
                        @include('components.completeForm', ['parameter' => 'dataScadenza', 'complete'=>1, 'type'=>'date', 'page' => 'promozioneDesigner'])
                        <input type="submit" value="Salva Modifiche"
                               formaction="{{route('editPromozione',['id'=>$promo->idPromozione])}}">
                        <input type="submit" value="ELIMINA"
                               formaction="{{route('eliminaPromozione',['idPromozione'=>$promo->idPromozione])}}">
                    </form>
                </center>
            @endforeach
            <br><br>
        @else
            <form method="POST" class="form">
                @csrf
                <label for="nomePromozione">Nome Offerta: </label>
                @include('components.completeForm', ['parameter' => 'nomePromozione', 'complete'=>0, 'type'=>'text', 'page' => 'promozioneDesigner'])
                <label for="oggetto">Oggetto:</label>
                @include('components.completeForm', ['parameter' => 'oggetto', 'complete'=>0, 'type'=>'text', 'page' => 'promozioneDesigner'])
                <label for="modalità">Modalità:</label>
                @include('components.completeForm', ['parameter' => 'modalità', 'complete'=>0, 'type'=>'text', 'page' => 'promozioneDesigner'])
                <label for="scontistica">Scontistica:</label>
                @include('components.completeForm', ['parameter' => 'scontistica', 'complete'=>0, 'type'=>'text', 'page' => 'promozioneDesigner'])
                <label for="luogoFruizione">Luogo Fruizione:</label>
                @include('components.completeForm', ['parameter' => 'luogoFruizione', 'complete'=>0, 'type'=>'text', 'page' => 'promozioneDesigner'])
                <label for="idAzienda">Azienda: </label>
                <?php $info = \App\Models\Azienda::all(); ?>
                <select id="idAzienda" name="idAzienda">
                    @for($i=0;$i<=sizeof($info)-1;$i++)
                        <option value="{{$info[$i]['idAzienda']}}">{{$info[$i]['nomeAzienda']}}</option>
                    @endfor
                </select><br><br>
                <label for="dataScadenza">Data di scadenza:</label>
                @include('components.completeForm', ['parameter' => 'dataScadenza', 'complete'=>0, 'type'=>'date', 'page' => 'promozioneDesigner'])
                <input type="submit" value="Crea" formaction="{{route('creaPromozione')}}">
            </form></center>
    <br><br>
    @endif
    @endif

@endsection
</html>
