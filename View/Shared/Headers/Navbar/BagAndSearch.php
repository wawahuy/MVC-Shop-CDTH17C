<li class="icon-bag" title="Túi đồ" href-click="{{YUH_URI_ROOT}}/bag">
    <span id="tuiHang-count">{{@Data:page_cart_product}}</span>
    <span id="tuiHang-add" class="tuiHang-add"></span>
</li>
<li class="search" id="search" title="Tìm kiếm" style="padding: 3px">
    <form action="{{YUH_URI_ROOT}}/categories" method="get">
        <input type="text" name="search" id="text-search" placeholder="Nhập từ khóa tìm kiếm" required>
        <input type="hidden" name="sort" value="new">
        <div class="bts" onclick="this.parentNode.submit()"></div>
    </form>
</li>