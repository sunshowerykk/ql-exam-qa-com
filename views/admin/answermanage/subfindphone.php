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
    <div class="con_w">
        <div class="w_top">
            <p><?=$v['subject']?></p>
        </div>
        <div class="w_middle">
            <div class="w">
                <span class="color_666">答疑方式</span>
                <span><?if($v['voice']==1 && $v['image']==1):?>语音讲解+图文讲解<?elseif ($v['voice']==1 && $v['image']==""):?>语音讲解<?elseif($v['voice']=="" && $v['image']=="1"):?>图文讲解<?endif;?></span>
            </div>
            <div class="w">
                <span class="color_666">所需金币</span>
                <span><?=$v['voicecoin']+$v['imagecoin']?>金币</span>
            </div>
        </div>
        <div class="w_bottom">
            <div class="a_wrap">
                <a href="javascript:void(0)" style="text-decoration:none" class="btn btn-info btn-xs"
                   data-url="?r=admin/answermanage/subdel&c1=<?=$v['id']?>&_k=<?=$rDelK?>&p=<?=$page->getNpage()?>"
                   data-confirm='确认要删除【<?=$v['subject']?>】吗？'
                   data-id="artHead"
                   onclick="artsubDel(this);return false;">
                    删除</a>
            </div>
            <div class="a_wrap">
                <a href="?r=admin/answermanage/subedit&c1=<?=$v['id']?>&_k=<?=$rEditK?>">编辑</a>
            </div>
        </div>
    </div>
</li>
<?endforeach;?>
<!--备注 -->
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
