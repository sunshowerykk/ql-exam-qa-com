<?php

use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
?>
<?foreach ($d_data as $v):?>
    <?
    $rOpenK=pub::enFormMD5('open',$v['id']);
    $rEditK=Pub::enFormMD5('edit',$v['id']);
    $rDelK=pub::enFormMD5('del',$v['id']);
    $rAddK=pub::enFormMD5('add',$v['id']);
    ?>
    <li>
        <a href="?r=admin/answermanage/feeindexdetail&c1=<?=$v['teachid']?>&c2=<?=$v['date']?>">
            <section class="w">
                <span class="color_333"><?=$v['teachname']?></span>
                <span class="color_db2c1b">+<?=$v['coin']?></span>
            </section>
            <section class="w">
                <span class="color_ccc"><?=$v['date']?></span>
                <span class="color_ccc"><?=$v['status']==1?'未兑现':'银行卡转账'?></span>
            </section>
        </a>
    </li>
<?endforeach;?>
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
