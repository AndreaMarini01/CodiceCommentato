<!DOCTYPE html>
<html lang="" >
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css/login.css') }}">
@endsection
@section('content')
    <div class="container">
        <table class="login-table">
            <tr>
                <td>
                    <h1>Accesso</h1>
                    <br>

                    <form method="POST" action="{{ route('loginPost') }}">
                        @csrf
                            <div>
                                <label for="username">Username:</label>
                                <br>
                                <br>

                                <input type="text" name="username" id="username" value="{{ old('username') }}" autofocus>
                                <!--$errors è una variabile predefinita di laravel che contiene i messaggi di errore
                                    definiti nelle FormRequest-->
                                @if ($errors->first('username'))
                                    <ul class="errore">
                                        @foreach ($errors->get('username') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <br>
                            <div>
                                <label for="password">Password:</label>
                                <br>
                                <br>
                                <input type="password" name="password" id="password" >
                                @if ($errors->first('password'))
                                    <ul class="errore">
                                        @foreach ($errors->get('password') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <br>

                            <div class="button-cell">
                                <button type="submit" class="btn-primary">Accedi</button>
                            </div>
                    </form>
                    <br>
                    <a href="{{ route('signup') }}" id="register-link">Non sei ancora un membro? Registrati qui.</a>
                </td>
            </tr>
        </table>
    </div>
@endsection
