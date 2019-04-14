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
                <p><?=$v['UserName']?></p>
                <p><?=$v['Phone']?></p>
            </div>
            <div class="w_middle">
                <div class="w">
                    <span class="color_666">答疑科目</span>
                    <span><?=$v['Subject']?></span>
                </div>
                <div class="w">
                    <span class="color_666">答疑量</span>
                    <span>300</span>
                </div>
                <div class="w">
                    <span class="color_666">评价得分</span>
                    <span>5分</span>
                </div>
            </div>
            <div class="w_bottom">
                <div class="a_wrap">
                    <a href="?r=admin/answermanage/teachedit&c1=<?=$v['id']?>&_k=<?=$rEditK?>">
                        <img src="assets/images/admin_a.png" />
                        编辑
                    </a>
                </div>
                <div class="a_wrap">
                    <a href="javascript:void(0)" style="text-decoration:none" class="btn btn-info btn-xs"
                       data-url="?r=admin/answermanage/teachdel&c1=<?=$v['id']?>&_k=<?=$rDelK?>&p=<?=$page->getNpage()?>"
                       data-confirm='确认要删除【<?=$v['UserName']?>】吗？'
                       data-id="artHead"
                       onclick="artTeachDel(this);return false;">
                        <img src="assets/images/admin_b.png" />
                        删除
                    </a>
                </div>
            </div>
        </div>
    </li>
</li>
<?endforeach;?>
<!--备注 -->
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
