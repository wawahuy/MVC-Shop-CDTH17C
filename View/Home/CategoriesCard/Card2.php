<div class="cm-col-50 hidden-scroll hidden-scrollefScroll3">
    <div class="cm-center cm-delatil2">
        <div class="cm-header"><?php  echo $DATA->name; ?></div>
        <button href-click="<?=URI_ROOT;?>/categories/<?=$DATA->id;?>/<?=$DATA->name;?>" class="cm-bt cm-bg-black">XEM NGAY</button>
    </div>
    <div class="cm-center cm-view">
        <ul>
            <?php
                $exp = explode("\r\n", $DATA->deltail);
                foreach($exp as $line)
                    echo '<li>'.$line.'</li>';
            ?>
        </ul>
    </div>
</div>
<div class="cm-col-50 cm-hover hidden-scroll hidden-scrollefScroll3">
    <img src="<?=$DATA->image; ?>" class="bgImg">
</div> 