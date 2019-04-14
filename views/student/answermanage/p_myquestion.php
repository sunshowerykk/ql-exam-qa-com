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
echo Html::cssFile('assets/css/examphone/dayi/w_20190118.css?r='.time());
?>
<style>
    body  {
        background: #fff0ed;
    }
    .ptUlFi li{
        position: relative;
    }

    .ptUlFi li p{
        font-size: 12px;
        color: #fff;
        position: absolute;
        left: 0px;
        bottom: 5px;
        margin-left: 0px;
        text-align: center;
        display: block;
        width: 100%;
        margin-bottom: 0px;
    }
</style>
<section class="wrap waiting_for_answer index put_Q myQ">
    <section class="testTop">
        <h6>我的问题列表</h6>
        <section class="w top_W lichoose">
            <ul>
                <li class="active" style="cursor:pointer; " data-id="1">未回答</li>
                <li style="cursor:pointer; " data-id="2">已回答</li>
            </ul>
        </section>
        <section class="w bottom_w">
            <ul>
                <li><a href="?r=student/answermanage">全部</a></li>
                <li class="active"><a href="?r=student/answermanage/myquestion">我的</a></li>
            </ul>
        </section>
    </section>

    <section class="adminContent">
        <ul id="formData">
            <?=Yii::$app->runAction('student/answermanage/findmyquestion',array('status'=>1))?>
        </ul>
        <ul class="ul_pFixd ptUlFi">
            <li>
                <a id="tiwen" href="?r=student/answermanage/createquestion">
                    <img class="home_tiwen" src="assets/images/phone/dayi/home_tiwen.png" alt="">
                </a>
            </li>
            <li>
                <img class="home_jinbi" src="assets/images/phone/dayi/home_jinbi.png" alt="">
                <p><?=intval(yii::$app->session['studentuser']['gold'])?></p>
            </li>
        </ul>
    </section>
    <!-- 弹窗/去充值 -->
    <section class="pop recharge_pop">
        <section class="rp">
            <section class="pop_con">
                <section class="w">
                    <img class="image_jinbired" src="assets/images/phone/dayi/image_jinbired.png" alt="">
                </section>
                <section class="w">
                    <p class="fz1rem">哎呀，金币不足啦！</p>
                    <p class="color_ccc">请充值后再继续提问~</p>
                </section>
                <section class="w">
                    <button onclick="togold()">去充值</button>
                </section>
            </section>
            <img class="icon_closeb" src="assets/images/phone/dayi/icon_closeb.png" alt="">
        </section>
    </section>
</section>
<script>
    $(function () {
        <?if(yii::$app->session['studentuser']['gold']<=0):?>
            $(".home_tiwen").click(function () {
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
    $(document).on('click','.lichoose li',function(){
            if(!$(this).hasClass('active')){
               $(this).addClass('active');
               $(this).siblings().removeClass('active');
               var status=$(this).data('id');
                findmyquestion(1,status);
            }
    });
    function findmyquestion(page,status){
        var url = '?r=student/answermanage/findmyquestion&p='+page+'&status='+status;
       // var data = $('#formHead').serialize();
        $.ajax({
            url:url,
            type: 'post',
          //  data: data,
            success: function (data) {
                $('#formData').html(data);
            }
        });
    }
</script>

