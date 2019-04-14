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
?>

<style>
    body {
        background: #ffefed;
    }
    .adminContent ul {
        overflow: hidden;
        width: 92%;
        margin-left: 6px;
        padding: unset;
    }
    .adminContent ul li {
        width: calc(100% / 3 - 20px);
        float: left;
        margin: 20px 0 0 20px;
        display: inline;
    }
    .adminContent ul li:first-child {
        margin: 20px 0 0 20px;
    }
    .adminContent ul li a {
        height: 92px;
        display: block;
        width: 100%;
    }
    .adminContent li img {
        width: 50px;
        height: 50px;
        margin: 10px auto 0;
    }
    .adminContent li p {
        text-align: center;
        font-size: 0.1rem;
    }
</style>

<section class="adminContent">
    <ul>
        <li>
            <a href="?r=admin/answermanage/subindex">
                <img src="assets/images/phone/dayi/icon_a.png" alt="">
                <p>答疑科目管理</p>
            </a>
        </li>
        <li>
            <a href="?r=admin/answermanage/teachindex">
                <img src="assets/images/phone/dayi/icon_b.png" alt="">
                <p>答疑教师管理</p>
            </a>
        </li>
        <li>
            <a href="?r=admin/answermanage/toanswerindex">
                <img src="assets/images/phone/dayi/icon_c.png" alt="">
                <p>待答问题列表</p>
            </a>
        </li>
        <li>
            <a href="?r=admin/answermanage/answeredindex">
                <img src="assets/images/phone/dayi/icon_d.png" alt="">
                <p>已答问题列表</p>
            </a>
        </li>
        <li>
            <a href="?r=admin/answermanage/feeindex">
                <img src="assets/images/phone/dayi/icon_e.png" alt="">
                <p>答疑收支管理</p>
            </a>
        </li>
    </ul>
</section>