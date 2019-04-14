<?php
use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
echo Html::cssFile('assets/artDialog/ui-dialog.css');
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框
echo Html::cssFile('assets/css/examphone/dayi/w_20190118.css?r='.time());
?>
<style>
    .ptPop{
        display: none;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        overflow: hidden;
        position: fixed;
        left: 0px;
        top: 0px;
        z-index: 99999;
    }

    .ptPop img{
        width: 100%;
        display: block;
        height: auto;
        position: absolute;
        left: 0px;
        top: 50%;
        margin-top: -28%;

    }

    .ptUl{
        display: flex;
        -webkit-justify-content: space-between;
        -moz-justify-content: space-between;
        -o-justify-content: space-between;
        justify-content: space-between;
        -webkit-align-items: center;
        -moz-align-items: center;
        -o-align-items: center;
        align-items: center;
        margin-top: 15px !important;
    }

    .ptUl li{
        display: flex;
        -webkit-justify-content:center !important;
        -moz-justify-content:center !important;
        -o-justify-content: center !important;
        justify-content:center !important;
        -webkit-align-items: center;
        -moz-align-items: center;
        -o-align-items: center;
        align-items: center;
        margin-top:0px !important;
    }

    .ptw{
        margin-top: 15px;
    }

    .ptDiva{
        overflow: hidden;
        background-color: #fff;
    }

    .ptBtn{
        width: 80px;
        margin: 0 auto 30px auto;
        display: block;
        border: none;
        background-color:  #1e68bf;
        text-align: center;
        border-radius: 50px;
        font-size: 12px;
        color: #fff;
        padding: 0px;
        line-height: 24px;
    }

</style>
<section class="wrap waiting_for_answer qd">

    <section class="adminContent">
        <ul>
            <li>
                <div class="con_w">
                    <div class="w_top">
                        <div class="w">
                            <p><?=$data['username']?></p>
                            <p><?=$data['intime']?></p>
                        </div>
                        <div class="w">
                            <img class="icon_jb" src="assets/images/phone/dayi/icon_jb.png" alt="">
                            <p><?if($data['type']==1):?><?=$data['imagecoin']?><?else:?><?=$data['voicecoin']?><?endif;?>金币</p>
                        </div>

                    </div>
                    <div class="w_middle">
                        <div class="w">
                            <h4>
                                <label><?=$data['subject']?></label>
                                <p><?=$data['content']?></p>
                            </h4>
                            <?if($data['type']==1):?>
                                <img class="exam_paper" src="http://<?=$data['FilePath']?>" alt="" style="cursor:pointer; ">
                            <?else:?>
                                <video controls=""  name="media">
                                    <source src="http://<?=$data['FilePath']?>" type="audio/mpeg">
                                </video>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="con_w">
                    <div class="w_top">
                        <div class="w">
                            <div class="avator_w">
                                <img class="avator_pic" src="<?if($data['teach']['headimg']!=""):?><?=$data['teach']['headimg']?><?else:?>assets/images/phone/dayi/defaultimg.png<?endif;?>" alt="">
                            </div>
                            <div class="txt_w">
                                <div class="txt">
                                    <span><?=$data['teachname']?></span>
                                </div>
                                <div class="txt">
                                    <span><?=$data['teach']['addtime']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w_middle">
                        <div class="w">
                            <h4>
                                <p><?=$data['teach']['teachcontent']?></p>
                            </h4>
                            <?foreach ($data['teach']['teachfile'] as $v):?>
                                <?if($v['type']==1):?>
                                    <img class="exam_paper" src="http://<?=$v['FilePath']?>" alt="" style="cursor:pointer; ">
                                <?else:?>
                                    <video controls=""  name="media">
                                        <source src="http://<?=$v['FilePath']?>" type="audio/mpeg">
                                    </video>
                                <?endif?>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </li>
            <div class="solid_line"></div>
            <?if($data['teach']['rank']=="" &&  $data['userid']==yii::$app->session['studentuser']['userid']):?>
            <section class="w ttb ptw">
                <p>评价老师</p>
                <ul class="ptUl">
                    <li data-id="5">
                        <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                        满意
                    </li>
                    <li data-id="4">
                        <img class="icon_select" src="assets/images/phone/dayi/icon_Select.png" alt="">
                        基本满意
                    </li>
                    <li data-id="3">
                        <img class="icon_select" src="assets/images/phone/dayi/icon_Select.png" alt="">
                        不满意
                    </li>
                    <input type="hidden" id="rank" value="5"/>
                </ul>
            </section>
            <?elseif($data['teach']['rank']<>"" &&  $data['userid']==yii::$app->session['studentuser']['userid']):?>
                <section class="w ttb ptw">
                    <p>评价老师</p>
                    <ul class="ptUl">
                        <?if($data['teach']['rank']==5):?>
                        <li data-id="5">
                            <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                            满意
                        </li>
                        <?elseif($data['teach']['rank']==4):?>
                        <li data-id="4">
                            <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                            基本满意
                        </li>
                        <?else:?>
                        <li data-id="3">
                            <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                            不满意
                        </li>
                        <?endif;?>
                    </ul>
                </section>
            <?endif;?>
        </ul>
    </section>
    <?if($data['teach']['rank']=="" &&  $data['userid']==yii::$app->session['studentuser']['userid']):?>
    <div class="ptDiva"> <a  href="javascript:void(0)"
                             data-url="?r=student/answermanage/rankhead&c1=<?=$data['teach']['id']?>"
                             data-confirm='确认提交评价？'
                             data-id="artHead"
                             onclick="artRank(this);return false;" class="ptBtn">提交评价</a></div>
    <?endif;?>

</section>
<div class="ptPop">
    <img id="tobig" src="" style="cursor:pointer; ">
</div>
<script>
    $(".w ul li").click(function () {
        $("#rank").val($(this).data('id'));
        $(".w ul li").children("img").attr("src", "assets/images/phone/dayi/icon_Select.png");
        $(this).children("img").attr("src", "assets/images/phone/dayi/icon_Selecta.png");
    })
    $(document).on('click','.exam_paper',function(){
        var link=$(this).attr('src')
        $("#tobig").attr('src',link);
        $(".ptPop").fadeIn();
    });
    $(document).on('click','#tobig',function(){
        $(".ptPop").fadeOut();
    });
    function artRank(that){
        var rank=$("#rank").val();
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
                            data: {"_csrf":'<?= Yii::$app->request->csrfToken ?>',rank:rank},
                            success: function (data) {
                                if (/\[0000\]/i.test(data)) {
                                    window.location.reload();
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
    }//放弃本题
</script>