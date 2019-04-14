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
<section class="wrap waiting_for_answer">
    <section class="testTop">
        <h6>待回答问题列表</h6>
        <section class="w">
            <p>全部科目</p>
            <img class="icon_downgray" src="assets/images/icon_downgray.png" alt="">
        </section>
    </section>

    <section class="adminContent">
        <ul>
            <li>
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
                        <div class="w">
                            <h4>
                                <label>语文</label>
                                <p>文言文问题，求解答~</p>
                            </h4>
                            <img class="exam_paper" src="assets/images/phone/dayi/image.png" alt="">
                        </div>
                    </div>
                    <div class="w_bottom">
                        <div class="a_wrap">
                            <a href="#">编辑类别</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </section>

    <!-- 弹窗/编辑类别 -->
    <section class="pop">

        <section class="editCategory_pop">
            <img class="icon_close" src="assets/images/phone/dayi/icon_close.png" alt="">
            <section class="pop_con">
                <section class="title">
                    <p>编辑类别</p>
                </section>
                <section class="w">
                    <p>选择科目</p>
                    <ul>
                        <li>
                            <p>语文</p>
                            <img class="icon_gou_noborder" src="assets/images/phone/dayi/icon_gou_noborder.png" alt="">
                        </li>
                        <li>
                            <p>数学</p>
                            <img class="icon_gou_noborder" src="assets/images/phone/dayi/icon_gou_noborder.png" alt="">
                        </li>
                        <li>
                            <p>英语</p>
                            <img class="icon_gou_noborder" src="assets/images/phone/dayi/icon_gou_noborder.png" alt="">
                        </li>
                        <li>
                            <p>计算机</p>
                            <img class="icon_gou_noborder" src="assets/images/phone/dayi/icon_gou_noborder.png" alt="">
                        </li>
                        <li>
                            <p>咨询</p>
                            <img class="icon_gou_noborder" src="assets/images/phone/dayi/icon_gou_noborder.png" alt="">
                        </li>
                    </ul>
                    <button>确定更改</button>
                </section>
            </section>
        </section>
    </section>
</section>


<script>

    $(function () {

        $('.a_wrap').click(function () {
            $('.pop').fadeIn();
        });
        $('.icon_close').click(function () {
            $('.pop').fadeOut();
        });

        var pop_aLis = $(".editCategory_pop .w ul li")
        pop_aLis.click(function () {
            pop_aLis.css("background-color", "#fff");
            pop_aLis.children("img").css("display", "none");
            $(this).css("background-color", "#fef3f1");
            $(this).children("img").css("display", "block");
        })
    })

</script>