<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\CRUDFaq\faq.css') }}">
@endsection

@section('content')
    <br>
    <br>

    @if(!empty($faq))
        @foreach ($faq as $xfaq)
            <button class="domanada-faq">{{ $xfaq->domanda }}</button>
            <div class="risposta">
                <p>{{ $xfaq->risposta }}</p>

                @if(isset(Auth::user()->nome))
                    @can('isAdmin')
                        <div class="faq-opt" style="float: right; display: inline">
                            <a class="faq-btn" href="{{route('faqedit',['id'=>$xfaq->id], ['option'=>'edit'])}}">Modifica
                                FAQ</a>&nbsp;
                            <a class="faq-btn" href="{{route('faqdelete',['id'=>$xfaq->id])}}">Elimina
                                FAQ</a>
                        </div>
                    @endcan
                @endif
            </div>
        @endforeach
    @endif
    @if(isset(Auth::user()->nome))
        @can('isAdmin')
            <br><br>
            <center>
                <a class="faq-btn" href="{{route('faqedit',['id'=>'create'], ['option'=>'create'])}}">Inserisci una nuova FAQ
                </a>
            </center>
        @endcan
    @endif


    <script>
        //'domanda-faq' sarebbe la domanda su cui clicco e poi mi viene
        //fuori la risposta
        var acc = document.getElementsByClassName("domanada-faq");
        var i;

        //Per ogni domanda, aggiungo un event handler (addEventListener) che permette
        //la visualizzazione della risposta
        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                //this si riferisce al documento generato dal Browser
                //Cambia il css (colore) della classe domanda-faq
                this.classList.toggle("active");
                //Restituisce l'elemento immediamente successivo nello stesso box
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>

@endsection
</html>
