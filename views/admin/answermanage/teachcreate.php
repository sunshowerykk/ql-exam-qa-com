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
echo Html::jsFile('assets/js/plupload.full.min.js');  //图片上userFlag传js
echo Html::cssFile('assets/css/common.css');  //图片上传js
echo Html::cssFile('assets/css/style.css');  //图片上传css
echo Html::cssFile('assets/zTree/css/zTreeStyle/zTreeStyle.css?r='.time());
echo Html::jsFile('assets/zTree/js/jquery.ztree.core-3.5.js');     //zTree插件
echo Html::jsFile('assets/zTree/js/jquery.ztree.excheck-3.5.js');     //zTree插件多選
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
</style>
<div class="contentRight">
    <div class="homeTit">答疑教师管理 / 添加新教师</div>
    <div class="homeCen addCen">
        <!-- 顶部搜索 -->
        <div class="homeCen addCen">
            <!-- 顶部搜索 -->
            <div class="homeCenTop adminAdd adTwoAdd">
                <form action="?r=admin/answermanage/teachsave" method="post" id="dialogForm" >
                    <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                    <input type='hidden' name='_k' value='<?=$rk?>' />
                    <input type='hidden' name='vP' value='<?=$rp?>' />
                    <input type='hidden' name='vCID' value='<?=$CID?>' />
                    <input type='hidden' name='vId' value='<?=pub::chkData($r_data,'id','')?>' />
                    <ul class="ptshiUl">
                        <li style="margin-left: 0px;">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;姓名</label>
                            <div class="homeSele">
                                <input type="text" class="c-set" name="vUserName" value="<?=pub::chkData($r_data,'UserName','')?>" data-chk='姓名' placeholder="输入姓名"/>
                            </div>
                        </li>
                        <li>
                            <label>手机号码</label>
                            <div class="homeSele">
                                <input type="text" class="c-i" name="vPhone" value="<?=pub::chkData($r_data,'Phone','')?>" data-chk='手机号码' placeholder="输入手机号码"/>
                            </div>
                        </li>
                        <li>
                            <label>密码</label>
                            <div class="homeSele">
                                <input type="password" class="c-set" name="vPassWord1" value="" placeholder="输入密码" data-chk='密码'/>
                            </div>
                        </li>
                        <li>
                            <label>确认密码</label>
                            <div class="homeSele" >
                                <input type="password" class="c-set" name="vPassWord2" value="" placeholder="确认密码" data-chk='请再次输入'/>
                            </div>
                        </li>
                        <li style="width: 50% !important;">
                            <label>答疑科目</label>
                            <div class="adminRadio">
                                <div class="adminRa">
                                    <?foreach ($s_data as $v):?>
                                    <img src="<?=strpos((pub::chkData($r_data,'AnswerSubject','')),$v['id']) !== false?'assets/images/icon_fanga.png':'assets/images/icon_fang.png'?>" />
                                    <p><?=$v['subject']?></p>
                                    <input type="checkbox" name="vAnswerSubject[]"  value="<?=$v['id']?>" <?=strpos((pub::chkData($r_data,'AnswerSubject','')),$v['id']) !== false?'checked="checked"':''?> />
                                    <?endforeach;?>
                                </div>
                            </div>
                        </li>

                        <p class="title">银行卡信息</p>
                        <li>
                            <label>开户行</label>
                            <div class="homeSele" >
                                <input type="text" class="c-set" name="vBank" value="<?=pub::chkData($r_data,'Bank','')?>" placeholder="开户行" data-chk='开户行'/>
                            </div>
                        </li>
                        <li>
                            <label>用户名</label>
                            <div class="homeSele" >
                                <input type="text" class="c-set" name="vAliname" value="<?=pub::chkData($r_data,'Aliname','')?>" placeholder="用户名" data-chk='用户名'/>
                            </div>
                        </li>
                        <li>
                            <label>卡号</label>
                            <div class="homeSele" >
                                <input type="text" class="c-set" name="vBankNum" value="<?=pub::chkData($r_data,'BankNum','')?>" placeholder="卡号" data-chk='卡号'/>
                            </div>
                        </li>
                        <li>
                            <label>支付宝账号</label>
                            <div class="homeSele" >
                                <input type="text" class="c-set" name="vAlinum" value="<?=pub::chkData($r_data,'Alinum','')?>" placeholder="支付宝账号" data-chk='支付宝账号'/>
                            </div>
                        </li>
                    </ul>
                    <div class="adminSc ">
                        <div class="adSc" id="btn">
                            上传照片
                        </div>
                        <ul id="ul_pics" class="ul_pics clearfix ptshiSc"></ul>
                        <?if($rop=='edit' && !empty($r_data['FileId'])):?>
                                <li style="list-style-type:none;">
                                    <div style=" float:left; display:inline" id="img<?=$r_data['FileId']?>">
                                        <img style="width:140px;height:120px;"  src='<?=$r_data['FilePath']?>'/>
                                        <i onclick=delimg('<?=$r_data['FileId']?>');>
                                            <img  title="删除图片" src='assets/img/access_disallow.gif'/>
                                        </i>
                                        <input type='hidden' id='vSrc<?=$r_data['FileId']?>' value='<?=$r_data['FilePath']?>'>
                                    </div>
                                </li>
                        <?endif;?>
                    </div>
                    <div class="adminSc adminTe">
                        <div class="adminTeDiv">
                            <label>简历</label>
                            <textarea class="homeSele" name="vContent">
                                <?=pub::chkData($r_data,'UserInfo','')?>
                            </textarea>
                        </div>
                        <div class="adPopBtn">
                            <button type="button" onclick="artSave('dialogForm')">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.adminRa').find('img').click(function(){
        if($(this).attr('src') == 'assets/images/icon_fang.png'){
            $(this).attr('src','assets/images/icon_fanga.png');
            $(this).next().next().attr("checked","checked");
        }else{
            $(this).attr('src','assets/images/icon_fang.png');
            $(this).next().next().attr("checked",false);
        }
    })
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
    var uploader = new plupload.Uploader({ //创建实例的构造方法
        runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
        browse_button: 'btn', // 上传按钮
        url: '/?r=admin/teachmanage/uphead&c1=<?=$CID?>', //远程上传地址
        flash_swf_url: 'assets/plupload/Moxie.swf', //flash文件地址
        silverlight_xap_url: 'assets/plupload/Moxie.xap', //silverlight文件地址
        accept:'image/*',
        filters: {
            max_file_size: '2000kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
            mime_types: [ //允许文件上传类型
                {
                    title: "files",
                    extensions: "jpg,png,gif,ico"
                }
            ]
        },
        multi_selection: false, //true:ctrl多文件上传, false 单文件上传
        init: {
            FilesAdded: function(up, files) { //文件上传前
                if ($("#ul_pics").children("li").length ==1) {
                    alert("您上传的图片太多了！");
                    uploader.destroy();
                } else {
                    var li = '';
                    plupload.each(files, function(file) { //遍历文件
                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                    });
                    $("#ul_pics").append(li);
                    uploader.start();
                }
            },
            UploadProgress: function(up, file) { //上传中，显示进度条
                var percent = file.percent;
                $("#" + file.id).find('.bar').css({
                    "width": percent + "%"
                });
                $("#" + file.id).find(".percent").text(percent + "%");
            },
            FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                var data = eval("(" + info.response + ")");
                $("#" + file.id).html("<div class='img' id='img" + data.uid + "'><img src='" + data.pic + "'/><i onclick=delimg('" + data.uid + "');><img src='assets/img/access_disallow.gif'/></i><input type='hidden' id='vSrc" + data.uid + "' value='"+ data.pic +"'></div>");
            },
            Error: function(up, err) { //上传出错的时候触发
                alert(err.message);
            }
        }
    });
    uploader.init();

    function delimg(uid) {//删除图片
        var src = $("#vSrc"+uid).val();
        var t ='img'+uid;
        $.ajax({
            url: '?r=admin/teachmanage/deluphead',
            type: 'post',
            data: {"src": src,"uid":uid},
            dataType:'json',
            success: function (data) {
                if (data == 1) {
                    $("#"+t).parent().remove();
                }
            }
        });
    }
</script>