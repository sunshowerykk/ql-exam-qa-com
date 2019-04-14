<?php

use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
?>

<style>
    .ptFaPop{
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        position: fixed;
        left: 0px;
        top: 0px;
        z-index: 100;
    }

    .ptFaPa{
        width: 9.16666666667rem;
        height: 5.16666666667rem;
        overflow: hidden;
        background-color: #fff;
        position: absolute;
        left: 50%;
        margin-left: -4.58333333333rem;
        top: 50%;
        margin-top: -2.58333333333rem;
    }
    .ptFaPa img{
        width: 100%;
        height: 100%;
        display: block;
        overflow: hidden;
    }
</style>
<!-- 表格 -->
<div class="homeTable">
    <table cellpadding="0"  cellspacing="0" align="center" rules="none" width="100%" class="homeTableHead teVisible">
        <tbody>
        <tr class="homeTrHead">
            <th>科目</th>
            <th>问题</th>
            <th>提交时间</th>
            <th>学员名称</th>
            <th>金币</th>
            <th>操作</th>
        </tr>

        <?foreach ($d_data as $v):?>
            <?
            $rOpenK=pub::enFormMD5('open',$v['id']);
            $rEditK=Pub::enFormMD5('edit',$v['id']);
            $rDelK=pub::enFormMD5('del',$v['id']);
            $rAddK=pub::enFormMD5('add',$v['id']);
            ?>
        <tr class="homeTrTwo">
            <td><?=$v['subject']?></td>
            <td>
                <?if($v['content']=="" && $v['filetype']==2):?>
                    <video controls=""  name="media">
                        <source src="http://<?=$v['FilePath']?>" type="audio/mpeg">
                    </video>
                <?else:?>
                    <div class="teHide"><?=$v['content']?></div>
                    <img data-id="http://<?=$v['FilePath']?>" class="tobig" width="30%"  src="http://<?=$v['FilePath']?>">
                <?endif;?>
            </td>
            <td><?=$v['intime']?></td>
            <td><?=$v['username']?></td>
            <td><?if($v['type']==1):?><?=$v['imagecoin']?><?else:?><?=$v['voicecoin']?><?endif;?>金币</td>
            <td class="adminTwoDiv">
                <div class="adCaoA">
                    <a href="?r=admin/answermanage/toansweredit&c1=<?=$v['id']?>&_k=<?=$rEditK?>">
                        <img src="assets/images/admin_a.png" />
                        <p>编辑</p>
                    </a>
                </div>
                <div class="adCaoA adCaoB">
                    <a href="javascript:void(0)" style="text-decoration:none" class="btn btn-info btn-xs"
                       data-url="?r=admin/answermanage/toanswerdel&c1=<?=$v['id']?>&_k=<?=$rDelK?>&p=<?=$page->getNpage()?>"
                       data-confirm='确认要删除【<?=$v['username']?>】的问题吗？'
                       data-id="artHead"
                       onclick="arttoanswerdelDel(this);return false;">
                        <img src="assets/images/admin_b.png" />
                        <p>删除</p>
                    </a>
                </div>
            </td>
        </tr>
        <?endforeach;?>
        </tbody>
    </table>
</div>
<!--备注 -->
<div id="page">
    <?if($page->getTotal_pages()>1){echo $page->show(1);}?>
</div>

<div class="ptFaPop" style="display: none">
  <div class="ptFaPa">
      <img id="bigimg" src="">
  </div>
</div>

<script>
    $(document).on('click','.tobig',function(){
        var url=$(this).data('id');
        $('#bigimg').attr('src',url)
        $(".ptFaPop").show();
    });
    $(document).on('click','#bigimg',function(){
        $(".ptFaPop").hide();
    });
</script>