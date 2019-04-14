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
            <th>答疑教师</th>
            <th>操作</th>
        </tr>

        <?foreach ($d_data as $v):?>
            <?
            $rOpenK=pub::enFormMD5('open',$v['teachanswerid']);
            $rEditK=Pub::enFormMD5('edit',$v['teachanswerid']);
            $rDelK=pub::enFormMD5('del',$v['teachanswerid']);
            $rAddK=pub::enFormMD5('add',$v['teachanswerid']);
            ?>
        <tr class="homeTrTwo">
            <td><?=$v['subject']?></td>
            <td>
                <?=$v['addtime']?>
            </td>
            <td><?=$v['username']?></td>
            <td><?if($v['type']==1):?><?=$v['imagecoin']?><?else:?><?=$v['voicecoin']?><?endif;?>金币</td>
            <td><?=$v['teachname']?></td>
            <td class="adminTwoDiv">
                <div class="adCaoA">
                    <a href="?r=admin/answermanage/answerdedit&c1=<?=$v['teachanswerid']?>&_k=<?=$rEditK?>">
                        <img src="assets/images/admin_a.png" />
                        <p>编辑回答</p>
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
