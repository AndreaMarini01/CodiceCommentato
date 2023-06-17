<!DOCTYPE html>
<html lang="">
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\signup.css') }}">
@endsection

@section('content')

    <div class="container">
        <table class="register-table">
            <tr>
                <td>
                    <h1>Registrazione</h1>
                    <br>

                    <form method="POST" action="{{ route('signupPost') }}">
                        @csrf
                        <div>
                            <label for="username">Username:</label>
                            <br>
                            <br>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" autofocus>
                            @if ($errors->first('username'))
                                <ul class="erroreUsername">
                                    @foreach ($errors->get('username') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <br><br>
                        <div class="column">
                            <div>
                                <label for="password">Password:</label>
                                <br>
                                <br>
                                <input type="password" name="password" id="password">
                                @if ($errors->first('password'))
                                    <ul class="errore">
                                        @foreach ($errors->get('password') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div>
                                <label for="password">Conferma Password:</label>
                                <br>
                                <br>
                                <input type="password" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                        <br><br>
                        <div class="column">
                            <div>
                                <label for="email">Email:</label>
                                <br>
                                <br>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" >
                                @if ($errors->first('email'))
                                    <ul class="errore">
                                        @foreach ($errors->get('email') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <label for="telefono">Telefono:</label>
                                <br><br>
                                <input type="tel" name="telefono" id="telefono" value="{{ old('telefono') }}">
                                @if ($errors->first('telefono'))
                                    <ul class="errore">
                                        @foreach ($errors->get('telefono') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="column">
                            <div>
                                <label for="nome">Nome:</label>
                                <br><br>
                                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" >
                                @if ($errors->first('nome'))
                                    <ul class="errore">
                                        @foreach ($errors->get('nome') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <label for="cognome">Cognome:</label>
                                <br><br>
                                <input type="text" name="cognome" id="cognome" value="{{ old('cognome') }}" >
                                @if ($errors->first('cognome'))
                                    <ul class="errore">
                                        @foreach ($errors->get('cognome') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="column">
                        <div>
                            <label for="DatadiNascita">Data di nascita:</label>
                            <br><br>
                            <input type="date" name="datadinascita" id="dataDiNascita" value="{{ old('dataDiNascita') }}" >
                            @if ($errors->first('datadinascita'))
                                <ul class="errore">
                                    @foreach ($errors->get('datadinascita') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div>
                            <label for="genere">Genere:</label>
                            <br><br>
                            <select name="genere" id="genere" required>
                                <option value="male" {{ old('genere') === 'male' ? 'selected' : '' }}>Maschio</option>
                                <option value="female" {{ old('genere') === 'female' ? 'selected' : '' }}>Femmina</option>
                                <option value="other" {{ old('genere') === 'other' ? 'selected' : '' }}>Altro</option>
                            </select>
                        </div>
                        </div>
                        <div class="button-cell">
                            <button type="submit" class="btn-primary">Registrati</button>
                        </div>
                    </form>

                    <a href="{{ route('login') }}" id="login-link">Hai già un account? Accedi qui.</a>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection
</html>
