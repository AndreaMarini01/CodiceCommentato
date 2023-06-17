<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDFaq\faqDesigner.css') }}">
@endsection

@section('content')
    <br>
    <center>
        @if($option=='edit')
            <br><br>
            <h2>Modifica Faq</h2>
        @endif
        @if($option=='create')
            <br><br>
            <h2>Crea Nuova Faq</h2>
        @endif
        <div>
            <form>
                @if(isset($faq))
                    @foreach($faq as $xfaq)

                        <label class="testo" for="domanda">Domanda:</label>
                        <textarea class="domanda" id="domanda" name="domanda" required>{{$xfaq->domanda}}</textarea>
                        <br>
                        <label class="testo2" for="risposta">Risposta: </label>
                        <textarea class="risposta" id="risposta" name="risposta" required>{{$xfaq->risposta}}</textarea>
                        <br>
                        <input class="button" type="submit" value="Modifica Faq" formaction="{{route('salvaFaq', ['id'=>$xfaq->id])}}">
                    @endforeach
                @else

                    <label for="domanda" class="testo">Inserisci una nuova domanda:</label>
                    <textarea class="domanda" id="domanda" name="domanda" required></textarea>
                    <br>
                    <label class="testo2" for="risposta">Inserisci una nuova risposta:</label>
                    <textarea class="risposta" id="risposta" name="risposta" rows="4" cols="50" required></textarea>
                    <br>
                    <input class="button" type="submit" value="Crea Faq"formaction="{{route('creaFaq')}}">
                @endif



            </form>


        </div>
    </center>
@endsection

</html>
