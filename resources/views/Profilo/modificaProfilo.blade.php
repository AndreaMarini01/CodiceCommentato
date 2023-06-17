<!DOCTYPE html>
<html>
@extends('layout.layout')

<link rel="stylesheet" type="text/css" href="{{URL('css\Profilo\profilo.css') }}">
@section('content')

    @if($utente=Auth::user())

        <center><form action="{{route('modificaProfiloPost')}}" method="POST" class="form">
                @csrf
                <h2>Modifica i tuoi dati personali</h2>
                @if($utente->role =='staff')
                    <!-- type = 'hidden' è necessario in quanto l'utente staff non può modifcare tutti i suoi campi-->
                    @include('components.completeForm', ['parameter' => 'username', 'complete'=>1, 'type'=>'hidden', 'page' => 'modificaProfilo'])
                @else
                    <label for="username">Username:</label>
                    @include('components.completeForm', ['parameter' => 'username', 'complete'=>1, 'type'=>'text', 'page' => 'modificaProfilo'])
                @endif

                <label for="username">Password:</label>
                @include('components.completeForm', ['parameter' => 'password', 'complete'=>0, 'type'=>'text', 'page' => 'modificaProfilo'])

                @if($utente->role =='staff')
                    @include('components.completeForm', ['parameter' => 'email', 'complete'=>1, 'type'=>'hidden', 'page' => 'modificaProfilo'])
                @else
                    <label for="email">Email:</label>
                    @include('components.completeForm', ['parameter' => 'email', 'complete'=>1, 'type'=>'text', 'page' => 'modificaProfilo'])
                @endif

                <label for="nome">Nome:</label>
                @include('components.completeForm', ['parameter' => 'nome', 'complete'=>1, 'type'=>'text', 'page' => 'modificaProfilo'])
                <label for="cognome">Cognome:</label>
                @include('components.completeForm', ['parameter' => 'cognome', 'complete'=>1, 'type'=>'text', 'page' => 'modificaProfilo'])

                @if($utente->role =='staff')
                    @include('components.completeForm', ['parameter' => 'telefono', 'complete'=>1, 'type'=>'hidden', 'page' => 'modificaProfilo'])
                    @include('components.completeForm', ['parameter' => 'datadinascita', 'complete'=>1, 'type'=>'hidden', 'page' => 'modificaProfilo'])
                    @include('components.completeForm', ['parameter' => 'genere', 'complete'=>1, 'type'=>'hidden', 'page' => 'modificaProfilo'])
                @else
                    <label for="telefono">Telefono:</label>
                    @include('components.completeForm', ['parameter' => 'telefono', 'complete'=>1, 'type'=>'tel', 'page' => 'modificaProfilo'])
                    <label for="datadinascita">Data di nascita:</label>
                    @include('components.completeForm', ['parameter' => 'datadinascita', 'complete'=>1, 'type'=>'date', 'page' => 'modificaProfilo'])
                    <label for="genere" class="opzioni">Genere:</label>
                    <select id="genere" name="genere">
                        <option value="maschio">Maschio</option>
                        <option value="femmina">Femmina</option>
                        <option value="altro">Altro</option>
                    </select><br><br>
                @endif

                <input type="hidden" id="user_id" name="user_id" value="{{$utente['id']}}">
                <input type="submit" value="Salva Modifiche">
            </form></center>
<br><br>
@endif
@endsection
