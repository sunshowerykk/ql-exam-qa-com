<?php
use yii\helpers\Html;
use app\models\langs;
use app\models\pub;

echo Html::cssFile('assets/css/examphone/dayi/w_20190118.css?r='.time());
?>
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
                                    <span>我</span>
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
            </li>
            <div class="solid_line"></div>
        </ul>

        <section class="w">
            <label for="evalution">学员评价</label>
            <section class="radio_w">
                <?if($data['teach']['rank']<>""):?>
                    <?if($data['teach']['rank']==5):?>
                        <li data-id="5">
                            <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                            满意&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['teach']['rank']?>分
                        </li>
                    <?elseif($data['teach']['rank']==4):?>
                        <li data-id="4">
                            <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                            基本满意&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['teach']['rank']?>分
                        </li>
                    <?else:?>
                        <li data-id="3">
                            <img class="icon_select" src="assets/images/phone/dayi/icon_Selecta.png" alt="">
                            不满意&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['teach']['rank']?>分
                        </li>
                    <?endif;?>
                <?else:?>
                暂无评价
                <?endif;?>
            </section>
        </section>
    </section>

</section>