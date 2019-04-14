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
    /*
* @Author: Marte
* @Date:   2019-01-15 11:09:56
* @Last Modified by:   Marte
* @Last Modified time: 2019-01-15 11:24:27
*/

    .homeCen {
        padding: 30px;
        background: #f5f5f5;
    }
    .homeCen ul {
        overflow: hidden;
    }
    .homeCen ul li {
        float: left;
        text-align: center;
        width: 243px;
        height: 180px;
        border: 1px solid #e6e6e6;
        background: #fff;
        margin-bottom: 30px;
    }
    .homeCen ul li + li {
        margin-left: 30px;
    }
    .homeCen ul li img {
        display: block;
        width: 60px;
        height: 54px;
        margin: 40px auto 18px;
    }
    .homeCen ul li a {
        display: block;
        color: #666;
        font-size: 15px;
    }
    .homeCen ul li:hover a {
        color: #db2c1b;
    }
    .homeCen ul li:hover img {
        background: url(../images/icon_Success.png) no-repeat 0 0;
    }
</style>
<div class="contentRight">
    <div class="homeTit">答疑管理</div>
    <div class="homeCen">
        <ul>
            <li>
                <img src="assets/images/dayi/icon_a.png" alt="">
                <a href="?r=admin/answermanage/subindex">答疑科目管理</a>
            </li>
            <li>
                <img src="assets/images/dayi/icon_b.png" alt="">
                <a href="?r=admin/answermanage/teachindex">答疑教师管理</a>
            </li>
            <li>
                <img src="assets/images/dayi/icon_c.png" alt="">
                <a href="?r=admin/answermanage/toanswerindex">待答问题列表</a>
            </li>
            <li>
                <img src="assets/images/dayi/icon_d.png" alt="">
                <a href="?r=admin/answermanage/answeredindex">已答问题列表</a>
            </li>
            <li>
                <img src="assets/images/dayi/icon_e.png" alt="">
                <a href="?r=admin/answermanage/feeindex">答疑收支管理</a>
            </li>
        </ul>
    </div>
</div>
<script>
</script>