@include    "/../Shared/HeadTag.php"

@call       JS_Add_Fix_Page()

@include    "/../Shared/Header.php"

<div class="container-fluid" style="border-bottom: none; margin: 130px 0 50px 0;">
    <div class="row">
        <div class="col-3">
            @include "Menu.php"
        </div>
        <div class="col-9">
            @eval @Data:page_code_body
        </div>
    </div>
</div>

@include    "/../Shared/Footer.php"