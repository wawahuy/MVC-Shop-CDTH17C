<div id="container-slides">
        @foreach @Data:home_slides as $slide
            <div class="slides"><img src="{{$slide}}" /></div>
            @endforeach
    <div class="btLeft"></div>
    <div class="btRight"></div>
</div>