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

<div class="contentRight">
    <div class="homeTit">答疑收支管理</div>
    <div class="homeCen">
        <div class="homeCenTop adminFour">
            <form class="" id="formHead">
                <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                <?if(Yii::$app->user->identity->RoleID==1):?>

                    <ul>
                        <li>
                            <label>年份</label>
                            <div class="homeSele">
                                <select name="year">
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
                                <img src="assets/images/icon_downgray.png" />
                            </div>
                        </li>
                        <li>
                            <label>月份</label>
                            <div class="homeSele">
                                <select name="month">
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
                                <img src="assets/images/icon_downgray.png" />
                            </div>
                        </li>
                        <li>
                            <label>答疑教师</label>
                            <div class="homeSele">
                                <select name="teachid">
                                    <option value="0">请选择</option>
                                    <?foreach ($t_data as $v):?>
                                        <option value="<?=$v['id']?>"><?=$v['UserName']?></option>
                                    <?endforeach;?>
                                </select>
                                <img src="assets/images/icon_downgray.png" />
                            </div>
                        </li>
                        <li>
                            <input type="button" name="" id="" onclick="findHead(1);" value="搜索" />
                        </li>
                    </ul>
                <?endif;?>
            </form>
        </div>
        <div class="headTa" id="headTa">
            <?=Yii::$app->runAction('admin/answermanage/findfee')?>
        </div>
    </div>
</div>
<script>
    function findHead(page){
        var url = '?r=admin/answermanage/findfee&p='+page;
        var data = $('#formHead').serialize();
        $.ajax({
            url:url,
            type: 'post',
            data: data,
            success: function (data) {
                $('.headTa').html(data);
            }
        });
    }
    function artConfirm(that){
        var m = $(that);
        var d = dialog({
            title:'确认提示',
            content: m.data('confirm'),
            button: [
                {
                    value: '取消',
                    callback: function () {},
                    autofocus: true
                },
                {
                    value: '确认',
                    callback: function () {
                        var url = m.data('url');
                        $.ajax({
                            url:url,
                            type: 'post',
                            data: {"_csrf":'<?= Yii::$app->request->csrfToken ?>'},
                            success: function (data) {
                                if (/\[0000\]/i.test(data)) {
                                    findHead(1);
                                }else{
                                    showMessage(data,3,'<?=langs::getTxt('infotitle')?>');
                                }
                            }
                        });
                    }
                }
            ]
        });
        d.showModal();
    }
</script>