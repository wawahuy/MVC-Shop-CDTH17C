<div class="cm-col-50 hidden-scroll hidden-scrollefScroll2">
    <img src="<?php echo $DATA->image; ?>" class="bgImg">
    <div class="door-cover-bot">
        <div class='cm-center'>
            <button href-click="<?=URI_ROOT;?>/categories/<?=$DATA->id;?>/<?=$DATA->name;?>" class="cm-bt-w cm-bg-red">XEM NGAY</button>
        </div>
    </div>
    <div class="door-cover-top">
        <div class='cm-center'>
            <div class="cm-header cl-white"><?php  echo $DATA->name; ?></div>
        </div>
    </div>
</div>
<div class="cm-col-50 hidden-scroll hidden-scrollefScroll3">
    <div class="cm-center cm-delatil">
        <div class="cm-header"><?=$DATA->name; ?></div>
        <button href-click="<?=URI_ROOT;?>/categories/<?=$DATA->id;?>/<?=$DATA->name;?>" class="cm-bt cm-bg-red">XEM NGAY</button>
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