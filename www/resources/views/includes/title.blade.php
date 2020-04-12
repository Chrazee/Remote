@if(is_array($title))
    @foreach($title as $t)
        {{ucfirst($t['name'])}} @if(!$loop->last) - @endif
    @endforeach
@else
    {{ucfirst($title)}}
@endif
