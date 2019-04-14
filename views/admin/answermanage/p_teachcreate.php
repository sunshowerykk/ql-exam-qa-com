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
<section class="wrap create_teacher">
    <section class="testTop ">
        <h6>添加新教师</h6>
    </section>
    <section class="testAdd">
    <form action="?r=admin/teachmanage/savehead" method="post" id="dialogForm" >
        <ul>
            <li>
                <label for="teacher_name">教师姓名</label>
                <section id="teacher_name" class="input_w">
                    <input type="text" placeholder="输入教师姓名">
                </section>
            </li>
            <li>
                <label for="tel">电话</label>
                <section id="tel" class="input_w">
                    <input type="number" placeholder="输入电话">
                </section>
            </li>
            <li>
                <label for="pwd">密码</label>
                <section id="pwd" class="input_w">
                    <input type="number" placeholder="输入密码">
                </section>
            </li>
            <li class="ttb">
                <label for="A_subject">答疑科目</label>
                <section id="A_subject" class="select_w">
                    <section class="each_w">
                        <em></em>
                        <span>语文</span>
                    </section>
                    <section class="each_w">
                        <em></em>
                        <span>数学</span>
                    </section>
                    <section class="each_w">
                        <em></em>
                        <span>英语</span>
                    </section>
                    <section class="each_w">
                        <em></em>
                        <span>计算机</span>
                    </section>
                    <section class="each_w">
                        <em></em>
                        <span>咨询</span>
                    </section>
                </section>
            </li>
            <li>
                <label for="avator">头像</label>
                <section id="avator" class="input_w avator">
                    <img class="avator_pic" src="assets/images/img_a.png" alt="">
                    <img class="icon_choose" src="assets/images/phone/images/icon_choose.png" alt="">
                </section>
            </li>
            <li class="ttb">
                <label for="resume">简历</label>
                <section id="resume" class="input_w">
                    <textarea name="" id="" cols="30" rows="2" placeholder="输入内容"></textarea>
                </section>
            </li>
        </ul>

        <ul>
            <h4>银行卡信息</h4>
            <li>
                <label for="deposit">开户行</label>
                <section id="deposit" class="input_w">
                    <input type="text" placeholder="输入开户行">
                </section>
            </li>
            <li>
                <label for="deposit">用户名</label>
                <section id="deposit" class="input_w">
                    <input type="text" placeholder="输入用户名">
                </section>
            </li>
            <li>
                <label for="deposit">卡号</label>
                <section id="deposit" class="input_w">
                    <input type="number" placeholder="输入卡号">
                </section>
            </li>
        </ul>
        <ul>
            <h4>支付宝账户</h4>
            <li>
                <label for="deposit">支付宝账号</label>
                <section id="deposit" class="input_w">
                    <input type="number" placeholder="输入手机号/邮箱">
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

    // 答疑科目
    $(function () {

        var each_w = $(".each_w");
        console.log(each_w.length);
        for(var i = 0;i < each_w.length;i++) {
            console.log(each_w[i]);
            $(each_w[i]).click(function () {
                $(this).children("em").css("background-image", "url(\'assets/images/phone/dayi/icon_goua.png\')");
            });
        }
    });
</script>