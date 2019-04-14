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
    <div class="homeTit">答疑科目管理</div>
    <div class="homeCen">
        <div class="homeCenTop">
            <ul>
                <?if((Yii::$app->user->identity->RoleID)==1):?>
                    <li class="adminInput">
                        <div><a href="?r=admin/answermanage/subcreate">创建新科目</a></div>
                    </li>
                <?endif;?>
            </ul>
        </div>
        <div class="headTa">
            <?=Yii::$app->runAction('admin/answermanage/subfind')?>
        </div>
    </div>
</div>
<script>
    function subfind(page){
        var url = '?r=admin/answermanage/subfind&p='+page;
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
    function artsubDel(that){
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
                                    subfind(m.data('p'));
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