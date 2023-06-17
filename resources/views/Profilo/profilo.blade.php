<!DOCTYPE html>
<html>
@extends('layout.layout')

<link rel="stylesheet" type="text/css" href="{{URL('css\Profilo\profilo.css') }}">
@section('content')


    @if($utente=Auth::user())

        <title>Visualizza Profilo</title>
        <h1>Il Mio Profilo</h1>
        <p>Benvenuto nel tuo profilo personale!</p>
        <table>
            <tr>
                <th>Username:</th>
                <td>{{$utente['username']}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{$utente['email']}}</td>
            </tr>
            <tr>
                <th>Nome:</th>
                <td>{{$utente['nome']}}</td>
            </tr>
            <tr>
                <th>Cognome:</th>
                <td>{{$utente['cognome']}}</td>
            </tr>
            <tr>
                <th>Telefono:</th>
                <td>{{$utente['telefono']}}</td>
            </tr>
            <tr>
                <th>Data di nascita:</th>
                <td>{{$utente['datadinascita']}}</td>
            </tr>
            <tr>
                <th>Genere:</th>
                <td>{{$utente['genere']}}</td>
            </tr>
        </table>
        <button onclick="location.href='{{route('modificaProfilo')}}'">Modifica Profilo</button>
        @can('isUser')
        <button onclick="location.href='{{route('couponSalvati')}}'">Visualizza Coupon Salvati</button>
        @endcan
@endif
@endsection
