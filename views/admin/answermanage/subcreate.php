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
?>
<style>
    .addNew li {
        width:  unset !important;
        margin-left: 1rem;
    }
    .con_wrap {
        overflow: hidden;
        margin-left: 0.2rem;
        position: relative;
    }
    .con_wrap label {
        display: inline-block;
        width: 24px !important;
        height: 24px;
        float: left;
        margin-right: 0.1rem;
        position: absolute;
        top: 6px;
        left: 0px;
    }
    .con_wrap label img {
        width: 100%;
        height: 100%;
    }
    .con_wrap span {
        font-size: 14px;
        line-height: 0.5rem;
        margin-left: 0.4rem;
    }
    .input_wrap {
        width: 1rem;
        height: 0.416666666667rem;
        overflow: hidden;
        border: solid 1px #e6e6e6;
        border-radius: 6px;
        background-color: #f5f5f5;
        margin-left: 0.2em;
        float: right;
    }
    .input_wrap input {
        border: none;
        outline: none;
        width: 100%;
        height: 100%;
        background: transparent;
        text-indent: 0.1rem;
    }
    .t-b-w li {
        margin-left: 0;
        margin-top: 20px;
    }
</style>
<div class="contentRight">
    <div class="homeTit">答疑科目管理 / 创建新科目</div>
    <div class="homeCen addCen">
        <!-- 顶部搜索 -->
        <div class="homeCen addCen">
            <!-- 顶部搜索 -->
            <div class="homeCenTop adminAdd adTwoAdd">
                <form action="?r=admin/answermanage/subsave" method="post" id="dialogForm" >
                    <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                    <input type='hidden' name='_k' value='<?=$rk?>' />
                    <input type='hidden' name='vP' value='<?=$rp?>' />
                    <input type='hidden' name='vCID' value='<?=$CID?>' />
                    <input type='hidden' name='vId' value='<?=pub::chkData($r_data,'id','')?>' />
                    <ul class="ptshiUl addNew">
                        <li>
                            <label>科目名称</label>
                            <div class="homeSele">
                                <input type="text" class="c-set" name="vSubject" id="vSubject" placeholder="科目名称" value="<?=pub::chkData($r_data,'subject','')?>" data-chk='科目名称'/>
                            </div>
                        </li>
                        <li>
                            <label>回答方式</label>
                            <div class="con_wrap">
                                <label>
                                    <img <?if(pub::chkData($r_data,'voice','')==1):?>src="assets/images/dayi/icon_xz.png"<?else:?>src="assets/images/dayi/icon_wxz.png"<?endif;?> alt="">
                                    <input type="hidden" name="vVoice" value="<?=pub::chkData($r_data,'voice','')?>">
                                </label>
                                <span>语音讲解</span>
                                <div class="input_wrap">
                                    <input type="number" name="vVoicecoin" placeholder="所需金币" value="<?=pub::chkData($r_data,'voicecoin','')?>">
                                </div>
                            </div>
                            <div class="con_wrap">
                                <label>
                                    <img <?if(pub::chkData($r_data,'image','')==1):?>src="assets/images/dayi/icon_xz.png"<?else:?>src="assets/images/dayi/icon_wxz.png"<?endif;?> alt="">
                                    <input type="hidden" name="vImage" value="<?=pub::chkData($r_data,'image','')?>">
                                </label>
                                <span>图文讲解</span>
                                <div class="input_wrap">
                                    <input type="number" name="vImagecoin" placeholder="所需金币" value="<?=pub::chkData($r_data,'imagecoin','')?>">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="t-b-w">
                        <li>
                            <div class="adSc" id="btn">
                                科目图标
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
                        </li>
                    </div>
                    <div class="adminSc adminTe">
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
    $('.con_wrap').find('img').click(function(){
        if($(this).attr('src') == 'assets/images/dayi/icon_wxz.png'){
            $(this).attr('src','assets/images/dayi/icon_xz.png');
            $(this).parent().find('input').val('1');
        }else{
            $(this).attr('src','assets/images/dayi/icon_wxz.png');
            $(this).parent().find('input').val('');
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
        accept:'image/*f',
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