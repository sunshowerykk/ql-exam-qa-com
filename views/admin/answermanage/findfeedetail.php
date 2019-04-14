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
            <th>提交时间</th>
            <th>学员名称</th>
            <th>金币</th>
            <th>答疑老师</th>
        </tr>

        <?foreach ($d_data as $v):?>
        <tr class="homeTrTwo">
            <td><?=$v['subject']?></td>
            <td><?=$v['addtime']?></td>
            <td><?=$v['username']?></td>
            <td><?=$v['coin']?>金币</td>
            <td><?=$v['teachname']?></td>
        </tr>
        <?endforeach;?>
        </tbody>
    </table>
</div>
<!--备注 -->
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
