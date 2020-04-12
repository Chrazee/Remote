<ul>
    @foreach($childs as $i)
        <li>
            <a href="{{route('settings.group.show', ['id' => $i->id])}}">
                <span data-toggle="tooltip" data-placement="top" title="{{$i->description}}">{{$i->name}}</span>
            </a>
            @if(count($i->child))
                @include('includes.group.childList',['childs' => $i->child])
            @endif
        </li>
    @endforeach
</ul>
