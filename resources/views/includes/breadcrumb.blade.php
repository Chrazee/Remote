@if(is_array($title))
    @foreach($title as $t)
        <a href="@if(array_key_exists('link', $t)){{$t['link']}}@endif">{{ucfirst($t['name'])}}</a> @if(!$loop->last) <i class="fa fa-chevron-right"></i> @endif
    @endforeach
@else
    {{ucfirst($title)}}
@endif
