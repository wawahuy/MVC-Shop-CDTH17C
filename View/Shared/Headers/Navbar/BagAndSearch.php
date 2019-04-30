<li class="icon-bag" title="Túi đồ" href-click="{{YUH_URI_ROOT}}/bag">
    <div id="tuiHang">
        <div class="bag-empty">Empty Bag!</div>
    </div>
    <span id="tuiHang-count">0</span>
    <span id="tuiHang-add" class="tuiHang-add"></span>
</li>
<li class="search" id="search" title="Tìm kiếm" style="padding: 3px">
    <form action="{{YUH_URI_ROOT}}/search" method="get">
        <input type="text" name="search" id="text-search" placeholder="Nhập từ khóa tìm kiếm" required>
        <div class="bts" onclick="this.parentNode.submit()"></div>
    </form>
</li>