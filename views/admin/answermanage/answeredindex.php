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
    <div class="homeTit">已回答问题列表</div>
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
            <?=Yii::$app->runAction('admin/answermanage/findanswerd')?>
        </div>
    </div>
</div>
<script>
    function findHead(page){
        var url = '?r=admin/answermanage/findanswerd&p='+page;
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