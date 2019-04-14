<?php
use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
echo Html::jsFile('assets/js/pub.js?r='.time());  //自定义
echo Html::cssFile('assets/artDialog/ui-dialog.css');
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框
echo Html::jsFile('assets/js/jquery-1.8.1.min.js');
echo Html::jsFile('assets/js/jquery.form.js');
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框
echo Html::cssFile('assets/css/public.css');
echo Html::cssFile('assets/css/examphone/dayi/w_20190118.css?r='.time());
?>
<style>
    body {
        background: #f5f5f5;
    }
</style>
<section class="wrap fee_detail">
    <section class="testTop">
        <h6>金币详情</h6>
    </section>

    <section class="adminContent">
        <ul>
            <li>
                <section class="w">
                    <span class="color_999">科目</span>
                    <span>语文</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">提交时间</span>
                    <span>2018-10-12 08:50:20</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">学员名称</span>
                    <span>张磊</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">金币</span>
                    <span>20金币</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_999">答疑老师</span>
                    <span>张莉老师</span>
                </section>
            </li>
        </ul>
    </section>

</section>

