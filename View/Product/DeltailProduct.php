    
        @call JS_SetVarNumber("YUH_MAX_PRODUCT", @Data:product->numProductCurrent);


        <?php
            function CreateOption($opt){
                $js = array();

                foreach ($opt as $key => $value) {
                    $js[$key] = "";
        ?>

                    <div>
                        <span><?=$key; ?>: </span>
                        <span>
                            <?php
                                foreach ($value as $child) {
                                    echo "<button>{$child}</button>";
                                }
                            ?>
                        </span>
                    </div>
                    <div style="padding: 20px;"></div>
        <?php
                }
        ?>
                <input name="option" type="hidden" value='<?= json_encode($js) ?>' />
        <?php
            }
        ?>

<style>
    .sp-c-vc ul {
        list-style: none;
        padding: 0px;
    }

    .sp-c-vc ul li:before
    {
        content: '\2713';
        margin: 0 1em;    /* any design */
    }

    .sp-c-vc {
        border-bottom: none;
    }

    .sp-c-add {
        border-top: none;
        border-bottom: 0.5px solid #ccc;     
        padding-bottom: 20px;   
    }

    .sp-c-phanloai {
        border-bottom: none;
    }

    .sp-c-kc {
        display: inline-block;
        margin-left: 40px;
    }
</style>

<form action="{{URI_ROOT}}/bag/add" method="POST" name="fproduct">
    <input type="hidden" name="id_product" value="{{@Data:product->id}}" />

<div class="sp-deltail">
    <div class="sp-c-deltail">
        <!--san phẩm-->
        <div class="sp-c-title">
            <div></div>
            <div id="sp-del-name">
                <!--Tên sản phảm-->
                {{@Data:product->name}}
            </div>
        </div>

        <!--giá sản phẩm-->
        <div class="sp-c-coin" id="sp-del-sale">
                @if @Data:product->sale != 0
                    @call $price_cur = @Data:product->price * (100 - @Data:product->sale)/100.0
                    @call $price_old = @Data:product->price
                    @call $price_old = number_format($price_old, 0, '', ',')
                @else 
                    @call $price_cur = @Data:product->price
                    @call $price_old = ""
                @endif

                @call $price_cur = number_format($price_cur, 0, '', ',')
                <div>{{$price_cur}}</div>
                <div>{{$price_old}}</div>
                <div>{{(@Data:product->sale == 0 ? @Data:product->note : @Data:product->sale.'%')}}</div>
        </div>

        <!--đánh giá-->
        <div class="pd-star-container noselect" id="sp-del-star">
                <?php
                    # <span `+(_js.star>0?'class="yes-st"':'')+`></span>
                    # $ ->maxstar số sao tối đa
                    # $ ->curstar số sao hiện tại
                    for($i=0; $i<View::$DATA['product']->maxstar; $i++){
                ?>
                    <span {{(@Data:product->curstar > $i ? "class='yes-st'" : '')}}></span>
                <?php
                    }
                ?>
        </div>

        <div class="sp-c-bl">Lượt xem: {{@Data:product->numView}}</div>

        <div class="sp-c-phanloai">
        
            <!--Tạo các Option Custom-->
            <div id="sp-pl">
                @if isset(@Data:product->jsonOption)
                    {{CreateOption(@Data:product->jsonOption)}}
                    @endif
            </div>

            <span>Số lượng:</span>
            <button class="sp-c-sl" style="margin-left: 10px" onclick="SSp.soLg(-1)">-</button>
            <input name="soluong" type="text" class="sp-c-sl" style="width: 50px; text-align: center;" id="tangSL" value=1>
            <button class="sp-c-sl" onclick="SSp.soLg(1)">+</button>
            <div class='sp-c-kc'>(Còn lại {{@Data:product->numProductCurrent}}, Đã bán {{@Data:product->numProductSold}} sản phẩm)</div>
        </div>

        <div class="sp-c-add">
            <input type="submit" class="bt-add-card" value="Thêm vào vỏ hàng" onclick="Add(this)" />
        </div>

        <div class="sp-c-vc">
            Mô tả:
            <ul>
                @call $fl = explode('\r\n', @Data:product->deltail)
                @foreach $fl as $line
                    <li>{{$line}}</li>
                @endforeach
            </ul>
        </div>


        <div style="padding: 10px;"></div>
    </div>
</div> 

</form>


<script>
    document.forms["fproduct"].onsubmit = function (e){
        e.preventDefault();
    }

    function Add(e){
        try {
            opt = document.getElementsByName("option")[0];
            opt = JSON.parse(opt.value);
            for( key in opt){
                if(opt[key] == ""){
                    swal("Lỗi", "Bạn cần chọn đầy đủ thông tin!", "error");
                    e.preventDefault();
                    return;
                }
            }
        } catch (e){}

        document.forms["fproduct"].submit();
    }

</script>