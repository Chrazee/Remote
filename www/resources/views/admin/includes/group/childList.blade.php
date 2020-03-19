<ul>
    @foreach($childs as $i)
        <li>
            <a data-id="{{$i->id}}" data-parent_id="{{$i->parent_id}}" data-user_id="{{$i->user_id}}" data-icon_id="{{$i->icon_id}}" data-name="{{$i->name}}" data-description="{{$i->description}}" data-default_icon_id="{{$defaultIcon->id}}">
            <span data-toggle="tooltip" data-placement="top" title="{{$i->description}}">{{$i->name}}</span>
                <img class="group-tree-icon" src="{{asset('assets/imgs/icons')}}/{{$i->icon->name}}">
            </a>
            @if(count($i->childs))
                @include('admin.includes.group.childList',['childs' => $i->childs])
            @endif
        </li>
    @endforeach
</ul>
