
<div class="sp-img">    
            @foreach @Data:product->image as $src
                <div class='sp-c-img'><img src='{{YUH_URI_ROOT}}/{{$src}}' /></div>
            @endforeach
</div> 