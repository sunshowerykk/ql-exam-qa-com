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

    .addCenPt{
        width: 95%;
    }

    .ptshiUlA{
        overflow: hidden;
        width: 90%;
        height: auto;
        margin: 0 auto;
        padding-bottom: 0.166666666667rem;
        padding-top: 0.166666666667rem;
    }

    .ptshiUlA dd{
        display: flex;
        margin-top: 0.183333333333rem;
    }

    .ptshiUlA dd:first-child{
        margin-top: 0px;
    }
    .ptshiUlA dd label{
        font-size: 0.15rem;
        color: #333;
        width:1rem ;
        text-align: right;
    }

    .ptshiUlA dd p{
        font-size: 0.15rem;
        color: #999;
    }

    .ptDiva{
        overflow: hidden;
        background-color: #f5f5f5;
        border: solid 1px #e6e6e6;
        margin-top: 0.25rem;
    }

    .ptDivB{
        overflow: hidden;
        margin-top: 0.291666666667rem;

    }
ol,li{list-style-type: none}
    .ptDivB ol{
        overflow: hidden;
    }

    .ptDivB ol li{
        overflow: hidden;
        border-bottom: dashed 1px #e6e6e6;
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    .ptDivB ol li h6{
        font-size: 0.2rem;
        color: #333;
        font-weight: normal;
    }

    .ptDivBa{
        overflow: hidden;
        height: auto;
        /*background-color: pink;*/
        margin-top: 0.25rem;
    }

    .ptDivC{
        overflow: hidden;
        display: flex;
        -webkit-align-items: center;
        -moz-align-items: center;
        -o-align-items: center;
        align-items: center;
        margin: 0.25rem auto;

    }

    .ptDivC label{
        font-size: 0.15rem;
        color: #333;
    }

    .ptDivCa{
        width: calc( 100% - 0.8rem );
        height: 0.333333333333rem;
        line-height: 0.333333333333rem;
        border: solid 1px #E6E6E6;
        border-radius: 0.05rem;
        background-color: #f5f5f5;
    }

    .ptDivCa input{
        border-radius: 0px;
        border: none;
        width: 100%;
        height: 100%;
        background-color: transparent;
        font-size: 0.15rem;
        color: #333;
        text-indent: 1em;
    }

    .ptDivCb{display: block;}

    .ptDivCbA{
        width:25%;
    }
    .ptDivCbA img{
        display: block;
        width: 100%;
        margin-top: 30px;
    }

    .ptLu{
        overflow: hidden;
        display: flex;
        -webkit-align-items: center;
        -moz-align-items: center;
        -o-align-items: center;
        align-items: center;

    }

    .ptTa{
        overflow: hidden;
    }
    .ptTa > div{
        float: left;
        margin-right: 0.2em;
    }

    .ptTa > div:last-child{
        margin-right: 0px;
    }

</style>
<div class="contentRight">
    <div class="homeTit">已回答问题 / 编辑回答</div>
    <div class="homeCen addCen addCenPt">
            <!-- 顶部搜索 -->
            <div class="homeCenTop adminAdd adTwoAdd">
                <form action="?r=teachmanage/teachmanage/teachsave" method="post" id="dialogForm" >
                    <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                    <input type='hidden' name='_k' value='<?=$rk?>' />
                    <input type='hidden' name='vP' value='<?=$rp?>' />
                    <input type='hidden' name='vId' value='<?=pub::chkData($r_data,'id','')?>' />
                    <div class="ptDiva">
                        <dl class="ptshiUlA " >
                            <dd>
                                <label>科目：</label>
                                <p><?=pub::chkData($s_data,'subject','')?></p>
                            </dd>
                            <dd>
                                <label>提交时间：</label>
                                <p><?=pub::chkData($s_data,'intime','')?></p>
                            </dd>
                            <dd>
                                <label>学员名称：</label>
                                <p><?=pub::chkData($s_data,'username','')?></p>
                            </dd>
                            <dd>
                                <label>金币：</label>
                                <p><?if($s_data['type']==1):?><?=$s_data['imagecoin']?><?else:?><?=$s_data['voicecoin']?><?endif;?>金币</p>
                            </dd>
                            <dd>
                                <label>答疑教师：</label>
                                <p><?=pub::chkData($s_data,'teachname','')?></p>
                            </dd>
                        </dl>
                    </div>

<!--                    100-->
                    <div class="ptDivB">
                         <ol>
                             <li>
                                 <h6><?=pub::chkData($s_data,'content','')?></h6>
                                 <div class="ptDivBa">
                                     <?if($s_data['type']==1):?>
                                         <img  src="http://<?=$s_data['FilePath']?>" alt="" style="width: 50%;height: 50%">
                                     <?else:?>
                                         <video controls=""  name="media">
                                             <source src="http://<?=$s_data['FilePath']?>" type="audio/mpeg">
                                         </video>
                                     <?endif;?>
                                 </div>
                             </li>
                         </ol>
                    </div>

                    <div class="ptDivC ptDivCb">
                        <div class="ptLu">
                         <label>老师回答：</label>
                        <div class="ptDivCa">
                            <input type="text" name="vTeachContent" value="<?=pub::chkData($r_data,'teachcontent','')?>" placeholder="输入老师回答" />
                        </div>
                        </div>

                        <div class="ptTa">
                            <div class="ptDivCbA">
                           <?foreach ($r_data['teachfile'] as $v):?>
                                    <?if($v['type']==1):?>
                                        <img class="exam_paper" src="http://<?=$v['FilePath']?>" alt="">
                                    <?else:?>
                                        <video controls=""  name="media">
                                            <source src="http://<?=$v['FilePath']?>" type="audio/mpeg">
                                        </video>
                                    <?endif?>
                            <?endforeach;?>
                            </div>
                        </div>
                    </div>
                        <div class="adPopBtn">
                            <button type="button" onclick="artSave('dialogForm')">确认修改</button>
                        </div>
                    </div>
                </form>
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