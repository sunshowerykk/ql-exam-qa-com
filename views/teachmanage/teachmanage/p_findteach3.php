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
<section class="wrap fee_manage">
    <section class="testTop">
        <h6>答疑收支管理</h6>
        <section>
            <section class="w">
                <p>年份</p>
                <img class="icon_downgray" src="assets/images/icon_downgray.png" alt="">
            </section>
            <section class="w">
                <p>月份</p>
                <img class="icon_downgray" src="assets/images/icon_downgray.png" alt="">
            </section>
        </section>
    </section>

    <section class="adminContent">
        <ul>
            <li>
                <a href="?r=admin/answermanage/feedetail">
                    <section class="w">
                        <span class="color_333">我</span>
                        <span class="color_db2c1b">+3</span>
                    </section>
                    <section class="w">
                        <span class="color_ccc">2018-10</span>
                        <span class="color_ccc">银行卡转账</span>
                    </section>
                </a>
            </li>
            <li>
                <section class="w">
                    <span class="color_333">我</span>
                    <span class="color_db2c1b">+300</span>
                </section>
                <section class="w">
                    <span class="color_ccc">2018-10</span>
                    <span class="color_ccc">银行卡转账</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_333">我</span>
                    <span class="color_db2c1b">+300</span>
                </section>
                <section class="w">
                    <span class="color_ccc">2018-10</span>
                    <span class="color_ccc">银行卡转账</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_333">我</span>
                    <span class="color_db2c1b">+300</span>
                </section>
                <section class="w">
                    <span class="color_ccc">2018-10</span>
                    <span class="color_ccc">银行卡转账</span>
                </section>
            </li>
            <li>
                <section class="w">
                    <span class="color_333">我</span>
                    <span class="color_db2c1b">+300</span>
                </section>
                <section class="w">
                    <span class="color_ccc">2018-10</span>
                    <span class="color_ccc">银行卡转账</span>
                </section>
            </li>
        </ul>
    </section>

</section>

