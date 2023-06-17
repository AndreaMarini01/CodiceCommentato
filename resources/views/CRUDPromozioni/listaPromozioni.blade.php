<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDPromozioni\listaPromozioni.css') }}">

@endsection

@section('content')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/filtri.js')}}"></script>

    @if (!Auth::check() or Gate::allows('isUser'))
        <div class="horizontal">
            <button id=filter-button type="button">FILTRI</button>
            <div id="filtri" class="filtri">
                <p>Barra di ricerca per i filtri:</p>
                <label>Cerca nome azienda</label>
                <input type="text" name="ricercaAzienda" id="ricercaAzienda"/>
                <label>Cerca parola chiave</label>
                <input type="text" name="ricercaParola" id="ricercaParola"/>
                <button id=close-button type="button">X</button>
            </div>
            </form>
        </div>
        <br><br><br><br><br>
    @endif

    <div id="all-data">
        @foreach($listaPromozioni as $promozione)
            @csrf
            <div class="promozione">
                <div><p id="nomePromozione"> Nome Offerta: {{$promozione->nomePromozione}} </p></div>
                <div class="sconto"><p id="scontistica"> Scontistica: {{$promozione->scontistica}}% </p></div>
                <div><p id="oggetto"> Oggetto Offerta: {{$promozione->oggetto}} </p></div>
                <div><p id="nomeAzienda"> Nome Azienda: {{$promozione->nomeAzienda}} </p></div>

                @can('isStaff')
                    <button class="bottoni1" onclick="location.href='{{route('modificaPromozione', ['idPromozione'=>$promozione->idPromozione])}}';">MODIFICA</button>
                    @endcan
                    <button class="bottoni2" onclick="location.href='{{route('visualPromozione', ['idPromozione'=>$promozione->idPromozione])}}';">VISUALIZZA</button>


                @can('isUser')
                    <div>
                        <button type="submit" class="salvaCoupon"
                                onclick="location.href='{{route('salvaCoupon', ['idPromozione'=>$promozione->idPromozione])}}';">
                            Salva coupon
                        </button>
                    </div>
                @endcan
            </div>

        @endforeach
        <br><br>
    </div>

    <div id="searched-content" class="searched-content"></div>
    <br><br>


    @can('isStaff')
        <div class="aggiungiOfferta">
            <button type="submit" onclick="location.href='{{route('promozioneCreator')}}';">+</button>
        </div>
    @endcan
    <br><br>
@endsection


</html>
