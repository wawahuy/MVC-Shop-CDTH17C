<style>
    .cm-c-cm {
        width: 100%;
        padding: 10px 10px 10px 20px;
        border-bottom: 0.5px dotted #cccccc;
        overflow: hidden;
    }

    .cm-c-cm:last-child {
        border-bottom: none;
    }

    .cm-c-cm button {
        margin-right: 10px;
        background-color: white;
        border: 1px solid black;
        font-weight: bold;
        font-size: 16px;
        width: 20px;
        height: 20px;
        padding: 0;
        line-height: 20px;
    }

    .hidden {
        height: 0;
        padding: 0;
    }

    .view {
        height: none;
        padding: none;
    }

    .select {
        font-weight: bold;
    }

</style>

<script>
    function Click(e, onlyopen = false){
        c = e.parentNode.getElementsByTagName("div")[0];

        if(e.innerHTML == "+"){
            try {
                e.parentNode.getElementsByTagName("a")[0].className = "select";
                e.innerHTML = "-";
                c.className = "cm-c-cm view";
            } catch(e){}

            if(e.parentNode.parentNode.className.indexOf("cm-c-cm") > -1)
                Click(e.parentNode.parentNode.getElementsByTagName("button")[0], true);
        }
        else if(e.innerHTML == "-" && !onlyopen){
            e.innerHTML = "+";
            e.parentNode.getElementsByTagName("a")[0].className = "";
            c.className = "cm-c-cm hidden";
        }
    }
</script>


<div class="cm-chuyenmuc">
    <div class="cm-c-chuyenmuc">
        <div class="cm-c-title">Chuyên mục</div>
        
            @call $ids = @Data:categorie_id

            <?php
                function CreateCategories($ct, $root = false){
            ?>

                @foreach $ct as $value
                    <div class='cm-c-cm {{$root ? "view" : "hidden"}}'>
                            <button id='btn_o_{{$value->id}}' onclick='Click(this)'>+</button>
                            <a href='{{YUH_URI_ROOT}}/categories/{{$value->id}}/{{str_replace(' ', '_', $value->name)}}?{{$_SERVER['QUERY_STRING']}}'>{{$value->name}}</a>
                
                            @if array_key_exists('child', $value)
                                @call CreateCategories($value->child)
                            @endif
                    </div>
                @endforeach

            <?php
                }
            ?>

            @call CreateCategories(@Data:page_menu, true)

        <script>
            Click(document.getElementById("btn_o_<?=$ids; ?>"), true);
        </script>

    </div>
</div> 