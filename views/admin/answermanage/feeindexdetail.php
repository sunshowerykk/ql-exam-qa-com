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
    <div class="homeTit">查看金币详情</div>
    <div class="homeCen">
        <div class="headTa" id="headTa">
            <?=Yii::$app->runAction('admin/answermanage/findfeedetail',array('teachid'=>$c1,'date'=>$c2))?>
        </div>
    </div>
</div>
<script>
    function findHead(page){
        var url = '?r=admin/answermanage/findfeedetail&p='+page+'&c1=<?=$c1?>&c2=<?=$c2?>';
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
</script>