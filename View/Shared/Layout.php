<!-- Sử dụng code mẫu định nghĩa ở Core/View.class.php-->

@include    "HeadTag.php"

@call       JS_Add_Fix_Page()

@include    "Header.php"

@eval       @Data:page_code_body

@include    "Footer.php"