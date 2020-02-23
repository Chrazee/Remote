<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->name }}
            @if(count($child->childs))
                @include('admin.includes.group.childList',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
