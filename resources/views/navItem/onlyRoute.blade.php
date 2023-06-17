@if( Request::is($route))
    <a class="active" href="{{route($route) }}"> {{$value}}</a>
@else
    <a href="{{ route($route) }}"> {{$value}} </a>
@endif




