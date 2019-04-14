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
echo Html::cssFile('assets/css/examphone/dayi/w_20190118.css?r='.time());
?>
<style>
    body {
        background: #f5f5f5;
    }
</style>
<section class="wrap create_subject">
    <section class="testTop">
        <h6>创建新科目</h6>
    </section>
    <section class="testAdd">
        <form action="?r=admin/answermanage/subsave" method="post" id="dialogForm" >
            <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
            <input type='hidden' name='_k' value='<?=$rk?>' />
            <input type='hidden' name='vP' value='<?=$rp?>' />
            <input type='hidden' name='vId' value='<?=pub::chkData($r_data,'id','')?>' />
            <ul>
                <li>
                    <label for="subject_name">科目名称</label>
                    <section id="subject_name" class="w">
                        <section class="input_w">
                            <input type="text" class="c-set" name="vSubject" id="vSubject" placeholder="科目名称" value="<?=pub::chkData($r_data,'subject','')?>" data-chk='科目名称'/>
                        </section>
                    </section>
                </li>
                <li class="ttb">
                    <label for="answer_type">回答方式</label>
                    <section id="answer_type" class="lists">
                        <section class="each_list">
                            <section class="icon_gou">
                                <input type="hidden" name="vVoice" value="<?=pub::chkData($r_data,'voice','')?>">
                            </section>

                            <section class="select_w">
                                <span>语音讲解</span>
                                <section class="input_w">
                                    <input type="number" name="vVoicecoin" placeholder="所需金币" value="<?=pub::chkData($r_data,'voicecoin','')?>">
                                </section>
                            </section>
                        </section>
                        <section class="each_list">
                            <section class="icon_gou">
                                <input type="hidden" name="vImage" value="<?=pub::chkData($r_data,'image','')?>">
                            </section>
                            <section class="select_w">
                                <span>图文讲解</span>
                                <section class="input_w">
                                    <input type="number" name="vImagecoin" placeholder="所需金币" value="<?=pub::chkData($r_data,'imagecoin','')?>">
                                </section>
                            </section>
                        </section>
                    </section>
                </li>
            </ul>
            <!--<button type="submit" class="adminHeadBtn">提交</button>-->
            <button type="button" class="adminHeadBtn" onclick="artSave('dialogForm')">添加</button>
        </form>
    </section>
</section>
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

    //图片封面上传

    // 回答方式
    $(function () {
        $(".icon_gou").click(function () {
            var host = location.host;
            var str='url("'+'http://'+host+'/assets/images/phone/dayi/icon_gou.png")';
            if( $(this).css("background-image") == str){
                $(this).css("background-image", "url('assets/images/phone/dayi/icon_goua.png')");
                $(this).find('input').val('1');
            }else{
                $(this).css("background-image", "url('assets/images/phone/dayi/icon_gou.png')");
                $(this).find('input').val('');
            }
        });
    })

</script>