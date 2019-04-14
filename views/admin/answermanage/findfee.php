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
            <th>年份</th>
            <th>月份</th>
            <th>教师姓名</th>
            <th>金币收入</th>
            <th>兑换方式</th>
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
            <td><?=substr ($v['date'],0,4)?></td>
            <td><?=substr ($v['date'],-2)?></td>
            <td><?=$v['teachname']?></td>
            <td><?=$v['coin']?>金币</td>
            <td><?=$v['status']==1?'未兑换':'已兑换'?></td>
            <td class="adminTwoDiv">
                <div class="adCaoA">
                    <a href="?r=admin/answermanage/feeindexdetail&c1=<?=$v['teachid']?>&c2=<?=$v['date']?>">
                        <p>查看金币详情</p>
                    </a>
                </div>
                <?if($v['status']==1):?>
                <div class="adCaoA">
                    <a href="javascript:void(0)" style="text-decoration:none" class="btn btn-info btn-xs"
                       data-url="?r=admin/answermanage/feeconfirm&c1=<?=$v['id']?>&_k=<?=$rEditK?>&p=<?=$page->getNpage()?>"
                       data-confirm='确认兑换【<?=$v['teachname']?>】的金币吗？'
                       data-id="artHead"
                       onclick="artConfirm(this);return false;">
                        <p>兑换金币</p>
                    </a>
                </div>
                <?endif;?>
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
