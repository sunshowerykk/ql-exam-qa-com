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
            <form class="" id="formHead">
                <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
            <section class="w">
                <label>年份</label>
                <div class="select_w">
                    <select name="qYear">
                        <option value="">请选择</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                    </select>
                    <img class="icon_downgray" src="assets/images/icon_downgray.png" alt="">
                </div>
            </section>
            <section class="w">
                <label>月份</label>
                <div class="select_w">
                    <select name="qMonth" id="qMonth">
                        <option value="">请选择</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <img class="icon_downgray" src="assets/images/icon_downgray.png" alt="">
                </div>
            </section>
            </form>
        </section>
    </section>

    <section class="adminContent">
        <ul id="formData">
            <?=Yii::$app->runAction('teachmanage/teachmanage/findpay')?>
        </ul>
    </section>
</section>
<script>
    $(document).on('change','#qMonth',function(){
        findpay(1);
    });
    function findpay(page){
        var url = '?r=teachmanage/teachmanage/findpay&p='+page;
        var data = $('#formHead').serialize();
        $.ajax({
            url:url,
            type: 'post',
            data: data,
            success: function (data) {
                $('#formData').html(data);
            }
        });
    }
</script>

