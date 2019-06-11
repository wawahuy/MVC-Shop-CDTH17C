<?php
    #Menu cấu trú tuân thủ theo cấu trúc trog MySql
    #   ----- Root
    #           ++ Chil1
    #                   +++Child1_1
    #           ++ Child2
    #           ++ ....
    # Mối node có các thông tin
    #       id, name, deltail, image
    
    function CreateMenu($menus, $root=false){
?>
        @if $root
            <ul class="sub">
            @endif

        @foreach $menus as $value
            <li>
            <a href="{{URI_ROOT}}/categories/{{$value->id}}/{{str_replace(' ', '_', $value->name)}}">{{$value->name}}</a>
            @if array_key_exists('child', $value)
                @call CreateMenu($value->child, true)
                @endif
            </li>
        @endforeach

        @if $root
            </ul>
            @endif
<?php
    }
?>

@call    CreateMenu(@Data:page_menu)