<script>
    page_current = <?=$YUH_ENTITY_CONTENT->pageCurrent; ?>;
    page_max = <?=$YUH_ENTITY_CONTENT->pageMax; ?>;

    function Change(e){
        swal("Thông báo", "Tính năng này đang phát triển!", "warning");
    }

    function Page(e){
        value = e.options[e.selectedIndex].value;
        f = location.href.indexOf("&idpage=");
        f = f == -1 ? location.href.length : f;
        location.href = location.href.substring(0, f)+"&idpage="+(value);
    }

    function GoPage(i){
        if(page_current + i <= 0  || page_current + i > page_max) return;
        f = location.href.indexOf("&idpage=");
        f = f == -1 ? location.href.length : f;
        location.href = location.href.substring(0, f)+"&idpage="+(page_current+i);
    }

</script>

<div class="cm-c-page" style="border-<?php echo $BORDER; ?>: 1px solid orangered; margin-bottom: 30px;">
    <select class="sort" onchange="Change(this)">
        <option>Sắp xếp</option>
        <option>A-Z</option>
        <option>Đánh giá cao</option>
        <option>Tiền thấp nhất</option>
        <option>Tiền cao nhât</option>
    </select>
    <div class="cm-c-right">
        Page:
        <select class="page" onchange="Page(this)">
            <?php
                for($i=1;$i <= $YUH_ENTITY_CONTENT->pageMax; $i++) 
                    echo "<option ".($i == $YUH_ENTITY_CONTENT->pageCurrent ? "selected" : "").">{$i}</option>"; 
            ?>
        </select>
        của <?= $YUH_ENTITY_CONTENT->pageMax; ?>
        <button class="btLeft" onclick="GoPage(-1)"></button>
        <button class="btRight" onclick="GoPage(+1)"></button>
    </div>
</div> 