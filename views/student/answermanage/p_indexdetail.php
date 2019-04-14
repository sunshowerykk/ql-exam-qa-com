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
    .headRight  {
        background: #fff;
    }
</style>
<section class="wrap index_detail">
    <section class="con">
        <section class="w">
            <section class="avator_w">
                <img class="avator_pic" src="assets/images/img_a.png" alt="">
            </section>
            <section class="txt_w">
                <p>丽丽老师</p>
                <p class="color_a9a9a9">2018-08-08&nbsp;&nbsp;15:20:12</p>
            </section>
        </section>
        <section class="w ttb">
            <p>问题解答在下面的图上哦，有不清楚的再联系我~</p>
            <img class="exam_paper" src="assets/images/phone/dayi/image.png" alt="">
        </section>
        <em class="bb1f5f5f5"></em>
        <section class="w ttb">
            <p>评价老师</p>
            <ul>
                <li>
                    <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                    满意
                </li>
                <li>
                    <img class="icon_select" src="assets/images/phone/dayi/icon_Select.png" alt="">
                    基本满意
                </li>
                <li>
                    <img class="icon_select" src="assets/images/phone/dayi/icon_Select.png" alt="">
                    不满意
                </li>
            </ul>
        </section>
    </section>
</section>

<script>

    $(function () {

        $(".w ul li").click(function () {
            $(".w ul li").children("img").attr("src", "assets/images/phone/dayi/icon_Select.png");
            $(this).children("img").attr("src", "assets/images/phone/dayi/icon_Selecta.png");
        })
    })
</script>
