<?php

use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
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

    .ptSpan img{
        margin-top: 2px !important;
        margin-left: 2px !important;
        width: 0.35rem !important;
        height: 0.5rem !important;
    }

</style>
<?foreach ($d_data as $v):?>
    <?
    $rOpenK=pub::enFormMD5('open',$v['id']);
    $rEditK=Pub::enFormMD5('edit',$v['id']);
    $rDelK=pub::enFormMD5('del',$v['id']);
    $rAddK=pub::enFormMD5('add',$v['id']);
    ?>
    <li>
        <div class="con_w">
            <div class="w_top">
                <div class="w">
                    <p><?=$v['username']?></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;<?=$v['intime']?></p>
                </div>
                <div class="w">
                    <img class="icon_jb" src="assets/images/phone/dayi/icon_jb.png" alt="">
                    <p><?if($v['type']==1):?><?=$v['imagecoin']?><?else:?><?=$v['voicecoin']?><?endif;?>金币</p>
                </div>

            </div>
            <div class="w_middle">
                <div class="w">
                    <?if($v['status']==2):?>
                    <a href="?r=student/answermanage/questiondetail&c1=<?=$v['id']?>">
                    <?endif;?>
                        <h4>
                            <label><?=$v['subject']?></label>
                            <p><?=$v['content']?></p>
                        </h4>
                    <?if($v['status']==2):?>
                    </a>
                    <?endif;?>
                    <?if($v['filetype']==1):?>
                        <img class="exam_paper" src="http://<?=$v['FilePath']?>" alt="" style="cursor:pointer; ">
                    <?else:?>
                        <video controls=""  name="media">
                            <source src="http://<?=$v['FilePath']?>" type="audio/mpeg">
                        </video>
                    <?endif;?>
                </div>
            </div>
            <?if($v['status']==1):?>
                <div class="w_bottom">
                    <span>未回答</span>
                </div>
            <?else:?>
                <div class="w_bottom">
                    <span data-id="<?=$v['teachid']?>">回答：<?=$v['teachname']?></span>
                    <a href="?r=student/answermanage/questiondetail&c1=<?=$v['id']?>" >详情 <span class="ptSpan"><img class="icon_choose" src="assets/images/phone/images/icon_choose.png" alt=""></span></a>
                </div>
            <?endif;?>
        </div>
    </li>
<?endforeach;?>
<!-- 弹窗/教师详情 -->
<section class="pop teacherDetail_pop">

    <section class="tdp">
        <section class="pop_con">
            <section class="title">
                <p>教师详情</p>
            </section>
            <section class="w">
                <section class="avator_w">
                    <img id="headimg" class="avator_pic" src="" alt="">
                </section>
                <section class="txt_w">
                    <section class="txt">
                        <span id="teachname"></span>
                        <span><img class="image_zaixian" src="assets/images/phone/dayi/image_zaixian.png" alt="">在线</span>
                    </section>
                    <section class="txt">
                        <span>解答: <em class="color_de4334"><span id="count"></span></em></span>
                        <span>得分：<em class="color_fad532"><span id="score"></span>分</em></span>
                    </section>
                </section>
            </section>
            <section class="w">
                <p class="color_999" id="userinfo"></p>
            </section>
        </section>
        <img class="icon_closeb" src="assets/images/phone/dayi/icon_closeb.png" alt="">
    </section>
</section>
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>
<div class="ptPop">
    <img id="tobig" src="" style="cursor:pointer; ">
</div>
<script>
    function togold(){
        window.location.href="https://www.kaoben.top/card?from=answer";
    }
    $(function () {
        <?if(yii::$app->session['studentuser']['gold']<=0):?>
        $(".home_tiwen").click(function () {
            console.log(123);
            $(".recharge_pop").css("display", "block");
        })
        <?endif;?>
        $(".recharge_pop .icon_closeb").click(function () {
            $(".recharge_pop").css("display", "none");
        })
        $(".w_bottom span").click(function () {
            var id =$(this).data('id');
            var url ="?r=student/answermanage/getteachbyid&id="+id;
            $('.detaDiv').empty();
            $.ajax({
                url:url,
                type:'post',
                dataType:'json',
                data: {"_csrf":'<?= Yii::$app->request->csrfToken ?>'},
                success: function (res) {
                    if(res.code==200){
                        $("#teachname").text(res.data.teachname);
                        if(res.data.FilePath!=null){
                            $("#headimg").attr('src',res.data.FilePath);
                        }else{
                            $("#headimg").attr('src',"assets/images/phone/dayi/defaultimg.png");
                        }
                        $("#count").text(res.data.count);
                        $("#score").text(res.data.score);

                        if(res.data.UserInfo.length>50){
                            var userinfo=res.data.UserInfo.substring(0,50)+"...";
                        }
                        $("#userinfo").text(userinfo);
                    }
                }
            });
            console.log(id);
            $(".teacherDetail_pop").css("display", "block");
        })
        $(".teacherDetail_pop .icon_closeb").click(function () {
            $(".teacherDetail_pop").css("display", "none");
        })
    })
    $(document).on('click','.exam_paper',function(){
        var link=$(this).attr('src')
        $("#tobig").attr('src',link);
        $(".ptPop").fadeIn();
    });
    $(document).on('click','#tobig',function(){
        $(".ptPop").fadeOut();
    });
</script>