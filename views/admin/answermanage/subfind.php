<?php

use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
?>
<!-- 表格 -->
<div class="homeTable">
    <table cellpadding="0"  cellspacing="0" align="center" rules="none" width="100%" class="homeTableHead teVisible">
        <tbody>
        <tr class="homeTrHead">
            <th>科目</th>
            <th>答疑方式</th>
            <th>所需金币</th>
            <th>操作</th>
        </tr>

        <?foreach ($d_data as $v):?>
            <?
            $rOpenK=pub::enFormMD5('open',$v['id']);
            $rEditK=Pub::enFormMD5('edit',$v['id']);
            $rDelK=pub::enFormMD5('del',$v['id']);
            $rAddK=pub::enFormMD5('add',$v['id']);
            ?>
        <tr class="homeTrTwo">
            <td><?=$v['subject']?></td>
            <td><?if($v['voice']==1 && $v['image']==1):?>语音讲解+图文讲解<?elseif ($v['voice']==1 && $v['image']==""):?>语音讲解<?elseif($v['voice']=="" && $v['image']=="1"):?>图文讲解<?endif;?></td>
            <td><?=$v['voicecoin']+$v['imagecoin']?>金币</td>
            <td class="adminTwoDiv">
                <div class="adCaoA">
                    <a href="?r=admin/answermanage/subedit&c1=<?=$v['id']?>&_k=<?=$rEditK?>">
                        <img src="assets/images/admin_a.png" />
                        <p>编辑</p>
                    </a>
                </div>
                <div class="adCaoA adCaoB">
                    <a href="javascript:void(0)" style="text-decoration:none" class="btn btn-info btn-xs"
                       data-url="?r=admin/answermanage/subdel&c1=<?=$v['id']?>&_k=<?=$rDelK?>&p=<?=$page->getNpage()?>"
                       data-confirm='确认要删除【<?=$v['subject']?>】吗？'
                       data-id="artHead"
                       onclick="artsubDel(this);return false;">
                        <img src="assets/images/admin_b.png" />
                        <p>删除</p>
                    </a>
                </div>
            </td>
        </tr>
        <?endforeach;?>
        </tbody>
    </table>
</div>
<!--备注 -->
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
