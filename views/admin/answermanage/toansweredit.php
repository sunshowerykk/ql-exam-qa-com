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
echo Html::cssFile('assets/css/public.css?r='.time());
?>

<style>
    .adminRa img {
        margin-left: 0.2rem;
    }
    .ptshiUl .title {
        width: 100%;
        font-size: 0.1rem;
        line-height: 0.2rem;
        margin-top: 0.2rem;
        color: #999999;
    }
</style>
<div class="contentRight">
    <div class="homeTit">待回答问题 / 编辑科目</div>
    <div class="homeCen addCen">
        <!-- 顶部搜索 -->
        <div class="homeCen addCen">
            <!-- 顶部搜索 -->
            <div class="homeCenTop adminAdd adTwoAdd">
                <form action="?r=student/answermanage/savequestion" method="post" id="dialogForm" >
                    <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                    <input type='hidden' name='_k' value='<?=$rk?>' />
                    <input type='hidden' name='vP' value='<?=$rp?>' />
                    <input type='hidden' name='vId' value='<?=pub::chkData($r_data,'id','')?>' />
                    <ul class="ptshiUl">
                        <li>
                            <label>科目</label>
                            <div class="homeSele">
                                <select name="vSubjectId">
                                    <option value="<?=pub::chkData($r_data,'subjectid','')?>"><?=pub::chkData($r_data,'subject','')?></option>
                                    <?foreach ($s_data as $v):?>
                                        <option value="<?=$v['id']?>"><?=$v['subject']?></option>
                                    <?endforeach;?>
                                </select>
                                <img src="assets/images/icon_downgray.png" />
                            </div>
                        </li>
                        <div class="adPopBtn">
                            <button type="button" onclick="artSave('dialogForm')">修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    fieldsCheck=new FieldsCheck();
    fieldsCheck.setFormat('c-s-15',"\\S{0,15}");
    fieldsCheck.setFormat('c-s-20',"\\S{0,20}");
    fieldsCheck.setFormat('c-s-30',"\\S{0,30}");
    fieldsCheck.setFormat('c-s-50',"\\S{0,50}");
    fieldsCheck.setFormat('c-s-100',"\\S{0,100}");
    fieldsCheck.setFormat('c-i-30',"\\d{0,30}");
    fieldsCheck.setFormat('c-f-2',"\\d+\\.?\\d{0,3}");//0-3位小数
    fieldsCheck.keyFire();
    function artSave(formid){
        var msg=fieldsCheck.checkMsg('#'+formid);
        if(msg.length>0){      //返回的數組大於0的時候則有錯誤
            var al=msg.join('<br>');    //直接用br鏈接返回錯誤
            showalert(al,'<?=langs::getTxt('infotitle')?>');
            return false;
        }
        $("#"+formid).ajaxSubmit({
            async: false, //同步提交，不对返回值做判断，设置true
            success: function(result){
                //返回提示信息
                if (/\[0000\]/i.test(result)){
                    showMessage('<?=langs::getTxt('saveOK')?>',2,'<??>');
                    history.back(-1);
                    //跳轉分頁
                   // findHead(1);
                }else{
                    showalert(result,'<?=langs::getTxt('infotitle')?>');
                }
            },
            error:function(){
                showMessage('<?=langs::getTxt('neterror')?>',2,'<?=langs::getTxt('infotitle')?>');
            }
        });
    }
</script>