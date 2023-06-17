<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CouponBeast</title>
    <link rel="stylesheet" type="text/css" href="{{URL('css\navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL('css\footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL('css\body.css') }}">
    @yield('customCss')

    <nav>
        <div class="navbar-left">
            <img src="{{URL('img\logo.png') }}" height="200"width="250" alt="Logo">
        </div>
        <div class="navbar-right">
            @include('navItem/onlyRoute', ['route'=>'home'], ['value'=>'Home'])
            @include('navItem/onlyRoute', ['route'=>'listaPromozioni'], ['value'=>'Catalogo'])
            @include('navItem/onlyRoute', ['route'=>'listaAziende'], ['value'=>'Info Aziende'])
            @include('navItem/onlyRoute', ['route'=>'faq'], ['value'=>'FAQ'])


            @if(!Auth::check())
                @include('navItem/onlyRoute', ['route'=>'login'], ['value'=>'Login'])
                @include('navItem/onlyRoute', ['route'=>'signup'], ['value'=>'Registrati'])
            @elseif (Auth::User()->role=='user' or Auth::User()->role=='staff')
                @include('navItem/onlyRoute', ['route'=>'profile'], ['value'=>'Profilo'])


            @elseif((Auth::User()->role)=='admin')
                @include('navItem/onlyRoute', ['route'=>'listaUtenti'], ['value'=>'Gestione Utenti'])
                    @include('navItem/onlyRoute', ['route'=>'statistiche'], ['value'=>'Statistiche'])
            @endif


                @include('navItem/logout')


        </div>

    </nav>
</head>
<br>
<body>
@yield('content')
</body>

@include('layout.footer')


</html>
