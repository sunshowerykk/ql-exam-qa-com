<?php

use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
echo Html::cssFile('assets/css/public.css?r='.time());
echo Html::cssFile('assets/artDialog/ui-dialog.css');
echo Html::jsFile('assets/js/pub.js?r='.time());  //自定义
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框
echo Html::jsFile('assets/js/jquery-1.8.1.min.js');
echo Html::jsFile('assets/js/jquery.form.js');
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框s
//echo Html::jsFile('assets/ueditor/ueditor.config.js');   //编辑器
//echo Html::jsFile('assets/ueditor/ueditor.all.min.js');  //编辑器
//echo Html::jsFile('assets/ueditor/lang/zh-cn/zh-cn.js'); //编辑器
?>
<section class="testTop ">
    <h6>题冒题管理</h6>
</section>

<form class="" id="formHead">
    <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
</form>
<section class="testCen">
    <ul id="formdata">
        <?=Yii::$app->runAction('admin/papermanage/findcap',array('QId'=>$QId))?>
    </ul>
</section>

<section class="testBottom"><a href="?r=admin/papermanage/createcap&QId=<?=$QId?>">添加题冒题选项</a></section>

<script>
    function findcap(page){
        var url = '?r=admin/papermanage/findcap&p='+page+'&QId=<?=$QId?>';
        var data = $('#formHead').serialize();
        $.ajax({
            url:url,
            type: 'post',
            data: data,
            success: function (data) {
                $('#formdata').html(data);
            }
        });
    }
    function artDelcap(that){
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
                                    findcap(m.data('p'));
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