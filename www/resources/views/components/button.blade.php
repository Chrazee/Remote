@php
    $color = "";
    $icon = "";
    $actionText = "";
@endphp

@switch($action)
    @case('save')
        @php
            $color = "outline-primary";
            $icon = '<i class="fas fa-check"></i>';
            $actionText = Lang::get('common.save');
        @endphp
    @break
    @case('edit')
        @php
            $color = "outline-info";
            $icon = '<i class="far fa-edit"></i>';
            $actionText = Lang::get('common.edit');
        @endphp
    @break
    @case('delete')
        @php
            $color = "outline-danger";
            $icon = '<i class="fas fa-trash-alt"></i>';
            $actionText = Lang::get('common.delete');
        @endphp
    @break
    @default
        @php
            $color = "outline-primary";
            $icon = '';
            $actionText = "";
        @endphp
@endswitch


<button
    class="btn btn-{{$color}} btn-{{$size}} action-{{$action}} @isset($extraClass){{$extraClass}}@endisset"
    type="{{$type}}"
    @isset($id)id="{{$id}}"@endisset
    @isset($disabled)
        @if($disabled)
            disabled
        @endif
    @endisset
>
    @if(!empty($icon))
        &nbsp;{!! $icon !!}
    @endif
    @if(isset($text))
        {{$text}}
    @else
        {{$actionText}}
    @endif

</button>
