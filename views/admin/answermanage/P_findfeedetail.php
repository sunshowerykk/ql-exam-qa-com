<?php

use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
?>
        <?foreach ($d_data as $v):?>
            <li>
                <section class="w">
                    <span class="color_999">科目</span>
                    <span><?=$v['subject']?></span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">提交时间</span>
                    <span><?=$v['addtime']?></span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">学员名称</span>
                    <span><?=$v['username']?></span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">金币</span>
                    <span><?=$v['coin']?>金币</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">答疑老师</span>
                    <span><?=$v['teachname']?></span>
                </section>
            </li>
        <?endforeach;?>
<!--备注 -->
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
