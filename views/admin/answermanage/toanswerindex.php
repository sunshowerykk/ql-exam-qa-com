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
    <div class="homeTit">待回答问题列表</div>
    <div class="homeCen">
        <div class="homeCenTop adminFour">
            <form class="" id="formHead">
                <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                <?if(Yii::$app->user->identity->RoleID==1):?>

                    <ul>
                        <li>
                            <label>科目</label>
                            <div class="homeSele">
                                <select name="subjectid">
                                    <option value="0">请选择</option>
                                    <?foreach ($s_data as $v):?>
                                        <option value="<?=$v['id']?>"><?=$v['subject']?></option>
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
            <?=Yii::$app->runAction('admin/answermanage/findtoanswer')?>
        </div>
    </div>
</div>
<script>
    function findHead(page){
        var url = '?r=admin/answermanage/findtoanswer&p='+page;
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
    function arttoanswerdelDel(that){
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
                                    findHead(m.data('p'));
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