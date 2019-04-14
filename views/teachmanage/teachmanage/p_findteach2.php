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
        background: #ffefed;
    }
</style>

<!-- 已答问题列表 -->
<section class="wrap waiting_for_answer index findteach2">
    <section class="testTop">
        <h6>已答问题列表</h6>
        <section class="w top_w">
            <ul>
                <li>
                    <a href="">
                        <img class="icon_subject" src="assets/images/phone/dayi/icon_yuwena.png" alt="">
                        语文
                    </a>
                </li>
                <li>
                    <a href="">
                        <img class="icon_subject" src="assets/images/phone/dayi/icon_shuxue.png" alt="">
                        数学
                    </a>
                </li>
                <li>
                    <a href="">
                        <img class="icon_subject" src="assets/images/phone/dayi/icon_yingyu.png" alt="">
                        英语
                    </a>
                </li>
            </ul>
        </section>
        <section class="w bottom_w">
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
                <a href="?r=teachmanage/teachmanage/questiondetail">
                    <div class="con_w">
                        <div class="w_top">
                            <div class="w">
                                <p>张磊同学</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;2018-12-24 12:00:12</p>
                            </div>
                            <div class="w">
                                <img class="icon_jb" src="assets/images/phone/dayi/icon_jb.png" alt="">
                                <p>10金币</p>
                            </div>

                        </div>
                        <div class="w_middle">
                            <a href="?r=teachmanage/teachmanage/questiondetail">
                                <div class="w">
                                    <h4>
                                        <label>语文</label>
                                        <p>文言文问题，求解答~</p>
                                    </h4>
                                    <img class="exam_paper" src="assets/images/phone/dayi/image.png" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </section>

</section>

