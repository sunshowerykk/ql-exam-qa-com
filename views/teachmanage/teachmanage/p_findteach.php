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
            <?if($v['status']==2):?>
            <a href="?r=teachmanage/teachmanage/questiondetail&c1=<?=$v['id']?>">
                <?endif;?>
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
                <?if($v['status']==2):?>
            </a>
        <?endif;?>
            <div class="w_middle" id="content">
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
            <?if($v['status']==1):?>
            <div class="w_bottom">
                <div class="a_wrap">
                    <a href="?r=teachmanage/teachmanage/aq&c1=<?=$v['id']?>&_k=<?=$rOpenK?>">抢答</a>
                </div>
            </div>
            <?endif;?>
        </div>
    </li>
<?endforeach;?>

<div class="ptPop">
    <img id="tobig" src="" style="cursor:pointer; ">
</div>

<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
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