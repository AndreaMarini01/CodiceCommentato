
<!--$complete, $page, $parameter e $type vengono passati dalle varie viste-->
@if($complete==1)
    <!--$complete=1 serve per il modifica-->
    @if($page=='promozioneDesigner')
    <input type="{{$type}}" id="{{$parameter}}" name="{{$parameter}}" value="{{$promo->$parameter}}">
    @elseif($page== 'modificaProfilo')
        <input type="{{$type}}" id="{{$parameter}}" name="{{$parameter}}" value="{{$utente[$parameter]}}">
    @elseif($page== 'modificaStaff')
        <input type="{{$type}}" id="{{$parameter}}" name="{{$parameter}}" value="{{$membro->$parameter}}">
    @elseif($page== 'aziendaDesigner')
        <input type="{{$type}}" id="{{$parameter}}" name="{{$parameter}}" value="{{$a->$parameter}}">
    @endif
@else
    <!--serve per il crea -->
    <input type="{{$type}}" id="{{$parameter}}" name="{{$parameter}}">
@endif





@if($type =='date')
    <br><br>
@endif

<!--Codice per la gestione degli errori -->
@if ($errors->first($parameter))
    <ul class="errore">
        @foreach ($errors->get($parameter) as $message)
            {{ $message }}
        @endforeach
    </ul>
@endif


@if($type!='hidden')
<br><br>
@endif
