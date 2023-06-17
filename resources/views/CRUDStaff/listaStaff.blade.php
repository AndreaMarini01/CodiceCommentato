<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDStaff\listaStaff.css') }}">
@endsection

@section('content')

    <div class="titolo">Gestisci i membri dello staff: </div>
    @if(sizeof($listaStaff)!=0)

    @foreach($listaStaff as $membro)
        <div class="staff" >
            <div><p id="username"> Nome utente: {{$membro->username}} </p></div>
            <div><p id="email"> Email: {{$membro->email}} </p></div>
            <div>
                <div class="bottoni1"> <button onclick="location.href='{{route('modificaStaff', ['id'=>$membro->id])}}';">Modifica</button> </div>
                <div class="bottoni2"> <button onclick="location.href='{{route('eliminaStaff', ['id'=>$membro->id])}}';">Elimina</button> </div>
            </div>
        </div>
    @endforeach
    @endif
    <div class="aggiungiStaff"><button onclick="location.href='{{route('staffCreator')}}';">+</button></div>


    <hr>
    <div class="titolo">Gestisci gli utenti: </div>
    @if(sizeof($listaUtenti)!=0)


    @foreach($listaUtenti as $membro)
        <div class="utente" >
            <div><p id="username"> Nome utente: {{$membro->username}} </p></div>
            <div><p id="email"> Email: {{$membro->email}} </p></div>
            <div>
                <div class="bottoni2"> <button onclick="location.href='{{route('eliminaStaff', ['id'=>$membro->id])}}';">Elimina</button> </div>
            </div>
        </div>
    @endforeach
        <br><br>

    @endif
    <br><br><br><br><br><br>
@endsection
</html>
