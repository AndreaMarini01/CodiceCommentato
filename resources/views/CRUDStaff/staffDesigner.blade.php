<!DOCTYPE html>
<html>
@extends('layout.layout')

<link rel="stylesheet" type="text/css" href="{{URL('css\CRUDStaff\staffDesigner.css') }}">
@section('content')

    @if($option == 'edit')
        <h2>Modifica Staff</h2>

    @endif
    @if($option == 'create')
        <h2>Crea nuovo membro dello staff</h2>
    @endif

    @if(isset($staff))
        @foreach($staff as $membro)
            <center>
                <form method="POST" class="form">
                    @csrf
                    <label for="username">Username:</label>
                    @include('components.completeForm', ['parameter' => 'username', 'complete'=>1, 'type'=>'text', 'page' => 'modificaStaff'])
                    <label for="password">Password:</label>
                    @include('components.completeForm', ['parameter' => 'password', 'complete'=>0, 'type'=>'text', 'page' => 'modificaStaff'])
                    <label for="email">Email:</label>
                    @include('components.completeForm', ['parameter' => 'email', 'complete'=>1, 'type'=>'email', 'page' => 'modificaStaff'])
                    <label for="nome">Nome:</label>
                    @include('components.completeForm', ['parameter' => 'nome', 'complete'=>1, 'type'=>'text', 'page' => 'modificaStaff'])
                    <label for="cognome">Cognome:</label>
                    @include('components.completeForm', ['parameter' => 'cognome', 'complete'=>1, 'type'=>'text', 'page' => 'modificaStaff'])
                    <label for="telefono">Telefono:</label>
                    @include('components.completeForm', ['parameter' => 'telefono', 'complete'=>1, 'type'=>'text', 'page' => 'modificaStaff'])
                    <label for="datadinascita">Data di nascita:</label>
                    @include('components.completeForm', ['parameter' => 'datadinascita', 'complete'=>1, 'type'=>'date', 'page' => 'modificaStaff'])
                    <label for="genere" class="opzioni">Genere:</label>
                    <select id="genere" name="genere">
                        <option value="maschio">Maschio</option>
                        <option value="femmina">Femmina</option>
                        <option value="altro">Altro</option>
                    </select><br><br>



                    <input type="hidden" id="user_id" name="user_id" value="{{$membro->id}}">
                    <input type="submit" value="Salva Modifiche" formaction="{{route('editStaff',['id'=>$membro->id])}}">
                    <input type="submit" value="Elimina" formaction="{{route('eliminaStaff',['id'=>$membro->id])}}">
                </form>
            </center>
        @endforeach
        <br><br>
    @else
        <center>
            <form method="POST" class="form">
                @csrf
                <label for="username">Username:</label>
                @include('components.completeForm', ['parameter' => 'username', 'complete'=>0, 'type'=>'text', 'page' => 'modificaStaff'])
                <label for="password">Password:</label>
                @include('components.completeForm', ['parameter' => 'password', 'complete'=>0, 'type'=>'text', 'page' => 'modificaStaff'])
                <label for="email">Email:</label>
                @include('components.completeForm', ['parameter' => 'email', 'complete'=>0, 'type'=>'email', 'page' => 'modificaStaff'])
                <label for="nome">Nome:</label>
                @include('components.completeForm', ['parameter' => 'nome', 'complete'=>0, 'type'=>'text', 'page' => 'modificaStaff'])
                <label for="cognome">Cognome:</label>
                @include('components.completeForm', ['parameter' => 'cognome', 'complete'=>0, 'type'=>'text', 'page' => 'modificaStaff'])
                <label for="telefono">Telefono:</label>
                @include('components.completeForm', ['parameter' => 'telefono', 'complete'=>0, 'type'=>'tel', 'page' => 'modificaStaff'])
                <label for="datadinascita">Data di nascita:</label>
                @include('components.completeForm', ['parameter' => 'datadinascita', 'complete'=>0, 'type'=>'date', 'page' => 'modificaStaff'])
                <label for="genere" class="opzioni">Genere:</label>
                <select id="genere" name="genere">
                    <option value="maschio">Maschio</option>
                    <option value="femmina">Femmina</option>
                    <option value="altro">Altro</option>
                </select><br><br>
                <input type="submit" value="Salva Modifiche" formaction="{{route('creaStaff')}}">
            </form>
        </center>
        <br><br>

@endif
@endsection
