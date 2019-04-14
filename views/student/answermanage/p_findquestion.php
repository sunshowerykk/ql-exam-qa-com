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
                    <h4>
                        <label><?=$v['subject']?></label>
                        <p><?=$v['content']?></p>
                    </h4>
                    <?if($v['filetype']==1):?>
                        <img class="exam_paper" src="http://<?=$v['FilePath']?>" alt="" style="cursor:pointer; ">
                    <?else:?>
                        <video controls=""  name="media">
                            <source src="http://<?=$v['FilePath']?>" type="audio/mpeg">
                        </video>
                    <?endif;?>
                </div>
        </div>
        <div class="w_bottom">
            <span data-id="<?=$v['teachid']?>">回答：<?=$v['teachname']?></span>
            <a href="?r=student/answermanage/questiondetail&c1=<?=$v['id']?>" >详情 <span><img class="icon_choose" src="assets/images/phone/images/icon_choose.png" alt=""></span></a>
        </div>
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
    $(document).on('click','.exam_paper',function(){
        var link=$(this).attr('src')
        $("#tobig").attr('src',link);
        $(".ptPop").fadeIn();
    });
    $(document).on('click','#tobig',function(){
        $(".ptPop").fadeOut();
    });
</script>