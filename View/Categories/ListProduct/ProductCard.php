<?php
    #Nếu bạn muốn include page này bạn bắt buộc có data theo cấu trúc enity ở Product.class.php
    #Data được lưu tại biến $DATA
    #   $DATA ->
    #       id
    #       image
    #       sale
    #       name
    #       star
    #       note
    #       price
?>

@if isset($DATA)

    @call $link = URI_ROOT."/product/$DATA->id"

    <a href="{{$link}}">
    <div class="pd-container">
        <div class="pd-look">
            
            <div class="pd-image"><img src="{{$DATA->image}}"></div>

            @if isset($DATA->note)
                    <div class="pd-sale"><span>{{$DATA->note}}</span></div>
            @else 
                @if isset($DATA->sale)
                    <div class="pd-sale"><span>-{{$DATA->sale}}%</span></div>
                @endif
            @endif

            <div class="pd-deltail">

                <?php
                    #$DATA->name tên của sản phểm
                    echo '<div class="pd-title">{{$DATA->name}}</div>';
                ?>

                <div class="pd-star-container noselect">
                    <?php
                        # <span `+(_js.star>0?'class="yes-st"':'')+`></span>
                        # $DATA->maxstar số sao tối đa
                        # $DATA->curstar số sao hiện tại
                        for($i=0; $i<$DATA->maxstar; $i++)
                            echo '<span '.($DATA->curstar > $i ? "class='yes-st'" : '').'></span>';
                    ?>
                </div>

                <div class="pd-add-card noselect">
                    <div class="pd-button-view" href-click='{{$link}}'>
                        <span>View</span>
                    </div>
                    <div class="pd-wait-add">
                        <span></span>
                    </div>
                    <div class="pd-com-add">
                        <span></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="pd-select">
            <div class="pd-view noselect"></div>
            <div class="pd-price">

                @call $price = $DATA->price
                @if isset($DATA->sale) && $DATA->sale!=0
                        @call $price_sale = $DATA->price*((100-$DATA->sale)/100)
                        @call $price_str  = number_format($price, 0, '', ',')
                        @call $price_sale = number_format($price_sale, 0, '', ',')

                        <span class="real">{{$price_str}}đ</span>
                        <span class="sale">{{$price_sale}}đ</span>
                @else
                    @call $price_str  = number_format($price, 0, '', ',')
                    <span class="no-sale">{{$price_str}}đ</span>
                @endif
            </div>
        </div>

    </div>
    </a>

@endif