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
        background: #f5f5f5;
    }
</style>
<section class="wrap fee_detail">
    <section class="testTop">
        <h6>金币详情</h6>
    </section>

    <section class="adminContent">
        <ul>
            <?=Yii::$app->runAction('admin/answermanage/findfeedetail',array('teachid'=>$c1,'date'=>$c2))?>

        </ul>
    </section>

</section>
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