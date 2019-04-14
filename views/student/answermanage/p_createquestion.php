<?php
use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
echo Html::jsFile('assets/js/pub.js?r='.time());  //自定义
echo Html::cssFile('assets/artDialog/ui-dialog.css');
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框
echo Html::jsFile('assets/js/jquery-1.8.1.min.js');
echo Html::jsFile('assets/js/jquery.form.js');
echo Html::jsFile('assets/js/recorder.mp3.min.js');
echo Html::jsFile('https://res2.wx.qq.com/open/js/jweixin-1.4.0.js');
echo Html::jsFile('assets/js/waveview.js');
echo Html::jsFile('assets/artDialog/dialog-plus.js');  //弹出框
echo Html::cssFile('assets/css/public.css');
echo Html::cssFile('assets/css/examphone/dayi/w_20190118.css?r='.time());

?>
<style>
    body  {
        background: #f5f5f5;
    }
    .headRight {
        height: auto;
    }
    .ptImg{
        position: relative;
        width: 4rem;
        height: 4rem;
        overflow: visible;
    }

    .ptImgDel{
        width: 22px;
        height: 22px;
        overflow: hidden;
        position: absolute;
        right: -11px;
        top: -11px;
        /* border: solid 1px red; */
        border-radius: 50%;
        margin-right: 0px;
        margin-top: 0px;
    }

</style>
<section class="wrap index put_Q">
    <section class="testTop">
        <h6>提问</h6>
        <section class="ltr">
            <label for="select_sub">选择科目</label>
            <section class="select_w">
                <select name="vSubject" id="vSubject" style="cursor: pointer;" >
                    <?foreach ($subject  as $k=>$v):?>
                        <?if($k==0):?>
                            <option value="<?=$v['id']?>" voice="<?=$v['voice']?>" image="<?=$v['image']?>" voicecoin="<?=$v['voicecoin']?>" imagecoin="<?=$v['imagecoin']?>" selected="selected" ><?=$v['subject']?></option>
                        <?else:?>
                            <option value="<?=$v['id']?>" voice="<?=$v['voice']?>" image="<?=$v['image']?>" voicecoin="<?=$v['voicecoin']?>" imagecoin="<?=$v['imagecoin']?>" ><?=$v['subject']?></option>
                        <?endif;?>
                    <?endforeach;?>
                </select>
                <img class="icon_choose" src="assets/images/phone/images/icon_choose.png" alt="">
            </section>
        </section>
        <em class="bb1f5f5f5"></em>
        <section class="w bottom_w">
            <ul>
                <li id="image" style="cursor:pointer;" class="active" <?if($subject[0]['image']==""):?>style="display: none"<?endif;?>>图文讲解(<?=$subject[0]['imagecoin']?>金币)
                </li>
                <li id="yuying" style="cursor:pointer;" <?if($subject[0]['voice']==""):?>style="display: none"<?endif;?>>语音讲解(<?=$subject[0]['voicecoin']?>金币)
                </li>
            </ul>
        </section>
    </section>
    <section class="adminContent" style="overflow: hidden">
        <form  action="?r=student/answermanage/savequestion" method="post" id="dialogForm" >
            <section class="sW">
                <section class="sW_each on image">
                    <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
                    <input type='hidden' name='_k' value='<?=$rk?>' />
                    <input type='hidden' name='vP' value='<?=$rp?>' />
                    <input type='hidden' name='vCID' value='<?=$CID?>' />
                    <input type="hidden" name="vSubjectId" id="vSubjectId" value="<?=$subject[0]['id']?>">
                    <input type="hidden" name="vType" id="vType" value="">
                    <input type="hidden" name="pic64" id="pic64" value="">
                    <section class="w">
                        <p>描述问题</p>
                        <textarea name="vContent" class="c-set" data-chk='描述问题' id="vContent" cols="30" rows="5" placeholder="在此输入问题"></textarea>
                        <section class="add_img_w">
                            <div class="ptImg" style="display: none" id="upimg">
                                <img id="imgdata" class="image_tjtp"  src="" alt="">
                                <img  class="ptImgDel" src="assets/images/dayi/icon_close.png" style="cursor:pointer; ">
                            </div>
                            <img id="upimage" style="cursor:pointer; " class="image_tjtp"  src="assets/images/phone/dayi/image_tjtp.png" alt="">

                        </section>
                    </section>
                    <button type="button" onclick="artSaveimage('dialogForm',1)">提交</button>
                </section>
                <section class="sW_each voice">
                    <p style="color:red;text-align: center">录音时长不要超过一分钟！</p>
                    <section class="wB">
                        <p id="showtime">
                            <span>00</span>
                            <span>:</span>
                            <span>00</span>
                        </p>
                    </section>
                    <div id="playvoice" style="display: none" >
                        <img class="icon_play"   src="assets/images/phone/dayi/icon_play.png">
                    </div>
                    <div>
                        <div style="height:6.25rem;width:100%;box-sizing: border-box;" class="recwave"></div>
                    </div>
                    <div id="playmusic" class="playmusic" style="display: none">
                        <audio class="recPlay" style="width:100%" controls="" src=""></audio>
                    </div>
                    <input type="hidden" name="vWxVoice" id="vWxVoice">
                    <section class="wA">
                        <ul>
                            <li id="start" style="cursor:pointer; " >开始录音</li>
                            <li id="use_rec" style="display: none;cursor:pointer;" >提交</li>
                            <li id="replace_rec" style="display: none;cursor:pointer;"  >重新录音</li>
                            <li id="stop" style="display: none;cursor:pointer;">结束录音</li>
                        </ul>
                    </section>
                </section>
            </section>
        </form>
    </section>

    <script>
        $(document).on('click','#upimage',function(){
            $("#caijian").attr("src","?r=student/answermanage/caijian&type=1");
            $("#caijian").show();
        });
        $(document).on('click','.ptImgDel',function(){
            $("#upimg").hide();
            $("#pic64").val("");
            $("#upimage").show();
        });
        fieldsCheck=new FieldsCheck();
        fieldsCheck.setFormat('c-s-15',"\\S{0,15}");
        fieldsCheck.setFormat('c-s-20',"\\S{0,20}");
        fieldsCheck.setFormat('c-s-30',"\\S{0,30}");
        fieldsCheck.setFormat('c-s-50',"\\S{0,50}");
        fieldsCheck.setFormat('c-s-100',"\\S{0,100}");
        fieldsCheck.setFormat('c-i-30',"\\d{0,30}");
        fieldsCheck.setFormat('c-f-2',"\\d+\\.?\\d{0,3}");//0-3位小数
        fieldsCheck.keyFire();
        function artSaveimage(formid,type){
            if(type==2){
                $("#pic64").val("");
                $("#vContent").val("").removeClass("c-set");
            }else{
                $("#vContent").addClass("c-set");
            }
            $("#vType").val(type);
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
                        <?if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')):?>
                        upqiniuwxvoice($("#vWxVoice").val());
                        <?endif;?>
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
        $(document).on('change','#vSubject',function(){
            var id= $(this).val();
            $("#vSubjectId").val(id);
            var voice=$(this).find("option:selected").attr("voice");
            var image=$(this).find("option:selected").attr("image");
            var voicecoin=$(this).find("option:selected").attr("voicecoin");
            var imagecoin=$(this).find("option:selected").attr("imagecoin");
            if(voice==1){
                $("#yuying").text("语音讲解("+voicecoin+"金币)")
                $("#yuying").show();
            }else{
                $("#yuying").hide();
            }
            if(image==1){
                $("#image").text("图文讲解("+imagecoin+"金币)")
                $("#image").show();
            }else{
                $("#image").hide();
            }
            if(voice==1 && image!=1 ){
                $("#yuying").text("语音讲解("+voicecoin+"金币)")
                $("#yuying").addClass("active");
                $("#image").removeClass("active");
                $(".voice").css("display","block");
                $(".image").css("display","none");
                $("#yuying").show();
            }else if(voice!=1 && image==1){
                $("#image").text("图文讲解("+imagecoin+"金币)")
                $("#yuying").removeClass("active");
                $("#image").addClass("active");
                $(".image").css("display","block");
                $(".voice").css("display","none");
                $("#image").show();
            }
            // alert(voice);
        })
        $(function () {
            var innerLis = $(".sW_each"),
                topLis = $(".bottom_w ul li");
            for(var i = 0;i < topLis.length;i++) {
                topLis[i].index = i;
                topLis[i].onclick = function () {

                    for(var i = 0;i < topLis.length;i++) {

                        topLis[i].className = "";
                        $(innerLis[i]).css("display","none");
                    }
                    console.log(this);
                    this.className = "active";
                    $(innerLis[this.index]).css("display","block");
                }
            }
        });
        <?if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')):?>
        wx.config({
            debug: false, // true开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: 'wx304ce55c64a3cbe7', // 必填，公众号的唯一标识
            timestamp:'<?=$timestamp?>', // 必填，生成签名的时间戳
            nonceStr:'<?=$noncestr?>', // 必填，生成签名的随机串
            signature:'<?=$signature?>',// 必填，签名，见附录1
            jsApiList: [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'startRecord',
                'stopRecord',
                'onVoiceRecordEnd',
                'playVoice',
                'stopVoice',
                'onVoicePlayEnd',
                'uploadVoice'
            ]
            // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function() {
            //返回音频的本地ID
            var localId;
            //返回音频的服务器端ID
            var serverId;
            //录音计时,小于指定秒数(minTime = 10)则设置用户未录音
            var startTime, endTime, minTime = 2;
            $('#start').on('click', function (e) {
                clearInterval(timer);
                timer = setInterval(showtime, 1000)
                setTimeout(function(){
                    //停止录音接口
                    wx.stopRecord({
                        success: function (res) {
                            endTime = new Date().getTime();
                            // alert((endTime - startTime) / 1000);
                            if ((endTime - startTime) / 1000 < minTime) {
                                localId = '';
                                serverId= '';
                                alert('录音少于' + minTime + '秒，录音失败，请重新录音');
                                min=0;
                                sec=0;
                              //  ms=0;
                                count=0;
                                $('#showtime span:eq(0)').html('00');
                                $('#showtime span:eq(2)').html('00');
                                clearInterval(timer);
                                $("#start").show();
                                $("#stop").hide();
                            }else {
                                localId = res.localId;
                                clearInterval(timer);
                                $(".recwave").hide();
                                $("#playvoice").show();
                                $("#use_rec").show();
                                $("#use_rec").attr("onclick","artSaveimage('dialogForm',2)")
                                $("#replace_rec").show();
                                $("#stop").hide();
                                wx.uploadVoice({
                                    //需要上传的音频的本地ID，由 stopRecord 或 onVoiceRecordEnd 接口获得
                                    localId: localId,
                                    //默认为1，显示进度提示
                                    isShowProgressTips: 1,
                                    success: function (res) {
                                        //返回音频的服务器端ID
                                        serverId = res.serverId;
                                        $("#vWxVoice").val(serverId)
                                    }
                                });
                            }
                        }
                    });
                }, 59000);
                e.preventDefault();
                startTime = new Date().getTime();
                //开始录音
                wx.startRecord({
                    success: function () {
                        localStorage.rainAllowRecord = 'true';
                        $("#start").hide();
                        $("#stop").show();
                    },
                    cancel: function () {
                        alert('用户拒绝授权录音');
                        $("#start").show();
                        $("#stop").hide();
                    }
                });
            });
            //重新录音
            $(document).on('click','#replace_rec',function (e) {
                setTimeout(function(){
                    //停止录音接口
                    wx.stopRecord({
                        success: function (res) {
                            endTime = new Date().getTime();
                            // alert((endTime - startTime) / 1000);
                            if ((endTime - startTime) / 1000 < minTime) {
                                localId = '';
                                serverId= '';
                                alert('录音少于' + minTime + '秒，录音失败，请重新录音');
                                min=0;
                                sec=0;
                             //   ms=0;
                                count=0;
                                $('#showtime span:eq(0)').html('00');
                                $('#showtime span:eq(2)').html('00');
                                clearInterval(timer);
                                $("#start").show();
                                $("#stop").hide();
                            }else {
                                localId = res.localId;
                                clearInterval(timer);
                                $(".recwave").hide();
                                $("#playvoice").show();
                                $("#use_rec").show();
                                $("#use_rec").attr("onclick","artSaveimage('dialogForm',2)")
                                $("#replace_rec").show();
                                $("#stop").hide();
                                wx.uploadVoice({
                                    //需要上传的音频的本地ID，由 stopRecord 或 onVoiceRecordEnd 接口获得
                                    localId: localId,
                                    //默认为1，显示进度提示
                                    isShowProgressTips: 1,
                                    success: function (res) {
                                        //返回音频的服务器端ID
                                        serverId = res.serverId;
                                        $("#vWxVoice").val(serverId)
                                    }
                                });
                            }
                        }
                    });
                }, 59000);
                e.preventDefault();
                startTime = new Date().getTime();
                wx.startRecord({
                    success: function () {
                        localStorage.rainAllowRecord = 'true';
                        min=0;
                        sec=0;
                     //   ms=0;
                        count=0;
                        $('#showtime span:eq(0)').html('00');
                        $('#showtime span:eq(2)').html('00');
                        clearInterval(timer);
                        timer=setInterval(showtime,1000)
                        $("#start").hide();
                        $("#use_rec").hide();
                        $("#replace_rec").hide();
                        $("#stop").show();
                    },
                    cancel: function () {
                        alert('用户拒绝授权录音');
                        $("#start").show();
                        $("#stop").hide();
                    }
                });
            });
            $('#stop').on('click', function () {
                //停止录音接口
                wx.stopRecord({
                    success: function (res) {
                        endTime = new Date().getTime();
                        // alert((endTime - startTime) / 1000);
                        if ((endTime - startTime) / 1000 < minTime) {
                            localId = '';
                            serverId= '';
                            alert('录音少于' + minTime + '秒，录音失败，请重新录音');
                            min=0;
                            sec=0;
                         //   ms=0;
                            count=0;
                            $('#showtime span:eq(0)').html('00');
                            $('#showtime span:eq(2)').html('00');
                            clearInterval(timer);
                            $("#start").show();
                            $("#stop").hide();
                        }else {
                            localId = res.localId;
                            clearInterval(timer);
                            $(".recwave").hide();
                            $("#playvoice").show();
                            $("#use_rec").show();
                            $("#use_rec").attr("onclick","artSaveimage('dialogForm',2)")
                            $("#replace_rec").show();
                            $("#stop").hide();
                            wx.uploadVoice({
                                //需要上传的音频的本地ID，由 stopRecord 或 onVoiceRecordEnd 接口获得
                                localId: localId,
                                //默认为1，显示进度提示
                                isShowProgressTips: 1,
                                success: function (res) {
                                    //返回音频的服务器端ID
                                    serverId = res.serverId;
                                    $("#vWxVoice").val(serverId)
                                }
                            });
                        }
                    }
                });
            });
            $('#playvoice').on('click','img',function(){
                if(!localId){
                    alert('您还未录音，请录音后再点击播放');
                    return;
                }
                if($(this).attr("src")=="assets/images/phone/dayi/icon_play.png"){
                    $(this).attr("src","assets/images/phone/dayi/icon_pause.png");
                    wx.playVoice({
                        localId: localId
                    });
                }else{
                    $(this).attr("src","assets/images/phone/dayi/icon_play.png");
                    //停止播放接口
                    wx.stopVoice({
                        localId: localId
                    });

                }
            });
            wx.onVoicePlayEnd({
                success: function (res) {
                    //   var localId = res.localId; // 返回音频的本地ID
                    $("#playvoice").children('img').attr("src","assets/images/phone/dayi/icon_play.png");
                }
            });
        });

        wx.error(function(res){
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
        });

        function upqiniuwxvoice(wxvoice) {//删除图片
            //var src = $("#vSrc"+uid).val();
            $.ajax({
                url: '?r=student/answermanage/upqiniuwxvoice',
                type: 'post',
                data: {"WxVoice":wxvoice,CID:"<?=$CID?>"},
                dataType:'json',
                success: function (data) {
                }
            });
        }
        <?else:?>

        function RandomKey(){
            return "randomkey"+(RandomKey.idx++);
        };
        RandomKey.idx=0;

        //录音初始化
        var rec;
        $(document).on('click','#yuying',function () {
            if(Recorder.Support()) {
                var type = "mp3";
                var bit = "16";
                var sample = 16000;
                var wave, waveSet = true;
                rec = Recorder({
                    type: type
                    , bitRate: bit
                    , sampleRate: sample
                    , onProcess: function (buffers, level, time, sampleRate) {
                        // $(".recpowerx").css("width",level+"%");
                        //$(".recpowert").html(time+"/"+level);
                        waveSet && wave.input(buffers[buffers.length - 1], level, sampleRate);
                    }
                });
                rec.open(function () {
                    console.log("已打开:" + type + " " + bit + "kbps");

                    wave = Recorder.WaveView({elem: ".recwave"});
                }, function (e, isUserNotAllow) {
                    console.log((isUserNotAllow ? "UserNotAllow，" : "") + "打开失败：" + e);
                });
            }
            else{
                alert("该浏览器不支持录音！");
            }
        })
        //开始录音
        $(document).on('click','#start',function () {
            if(rec){
                rec.start();
                clearInterval(timer);
                timer=setInterval(showtime,1000)
                $("#start").hide();
                $("#stop").show();
                setTimeout(function(){
                    clearInterval(timer);
                    if(rec){
                        // if(!batCall){
                        //     console.log("正在编码"+rec.set.type+"...");
                        // };
                        var t1=Date.now();
                        rec.stop(function(blob,time){
                            if(time>60000){
                                alert("录音时间过长！不要超过一分钟！");
                                if(rec){
                                    rec.start();
                                    min=0;
                                    sec=0;
                                 //   ms=0;
                                    count=0;
                                    $('#showtime span:eq(0)').html('00');
                                    $('#showtime span:eq(2)').html('00');
                                    clearInterval(timer);
                                    timer=setInterval(showtime,1000)
                                    $("#start").hide();
                                    $("#use_rec").hide();
                                    $("#replace_rec").hide();
                                    $("#stop").show();
                                    console.log("录制中...");
                                };
                            }else{
                                console.log(time);
                                blob11=blob;
                                var id=RandomKey(16);
                                recblob[id]={blob:blob,set:$.extend({},rec.set),time:time};
                                $(".recwave").hide();
                                $("#playmusic").show();
                                $("#use_rec").show();
                                $("#replace_rec").show();
                                $("#stop").hide();
                                $("#use_rec").attr("onclick","savevoice();")
                                recplay(id);
                            }
                        },function(s){
                            alert("录音失败："+s);
                            // batCall&&batCall();
                        });
                    };
                }, 59000);
                console.log("录制中...");
            };
        });
        //重新录音
        $(document).on('click','#replace_rec',function () {
            setTimeout(function(){
                clearInterval(timer);
                if(rec){
                    // if(!batCall){
                    //     console.log("正在编码"+rec.set.type+"...");
                    // };
                    var t1=Date.now();
                    rec.stop(function(blob,time){
                        if(time>60000){
                            alert("录音时间过长！不要超过一分钟！");
                            if(rec){
                                rec.start();
                                min=0;
                                sec=0;
                             //   ms=0;
                                count=0;
                                $('#showtime span:eq(0)').html('00');
                                $('#showtime span:eq(2)').html('00');
                                clearInterval(timer);
                                timer=setInterval(showtime,1000)
                                $("#start").hide();
                                $("#use_rec").hide();
                                $("#replace_rec").hide();
                                $("#stop").show();
                                console.log("录制中...");
                            };
                        }else{
                            console.log(time);
                            blob11=blob;
                            var id=RandomKey(16);
                            recblob[id]={blob:blob,set:$.extend({},rec.set),time:time};
                            $(".recwave").hide();
                            $("#playmusic").show();
                            $("#use_rec").show();
                            $("#replace_rec").show();
                            $("#stop").hide();
                            $("#use_rec").attr("onclick","savevoice();")
                            recplay(id);
                        }
                    },function(s){
                        alert("录音失败："+s);
                        // batCall&&batCall();
                    });
                };
            }, 59000);
            if(rec){
                rec.start();
                min=0;
                sec=0;
              //  ms=0;
                count=0;
                $('#showtime span:eq(0)').html('00');
                $('#showtime span:eq(2)').html('00');
                clearInterval(timer);
                timer=setInterval(showtime,1000)
                $("#start").hide();
                $("#use_rec").hide();
                $("#replace_rec").hide();
                $("#stop").show();
                console.log("录制中...");
            };
        });
        //结束录音
        var recblob={};
        var blob11="";
        $(document).on('click','#stop',function () {
            //  function recstop(batCall){
            clearInterval(timer);
            if(rec){
                // if(!batCall){
                //     console.log("正在编码"+rec.set.type+"...");
                // };
                var t1=Date.now();
                rec.stop(function(blob,time){
                    if(time>60000){
                        alert("录音时间过长！不要超过一分钟！");
                        if(rec){
                            rec.start();
                            min=0;
                            sec=0;
                           // ms=0;
                            count=0;
                            $('#showtime span:eq(0)').html('00');
                            $('#showtime span:eq(2)').html('00');
                            clearInterval(timer);
                            timer=setInterval(showtime,1000)
                            $("#start").hide();
                            $("#use_rec").hide();
                            $("#replace_rec").hide();
                            $("#stop").show();
                            console.log("录制中...");
                        };
                    }else{
                        console.log(time);
                        blob11=blob;
                        var id=RandomKey(16);
                        recblob[id]={blob:blob,set:$.extend({},rec.set),time:time};
                        $(".recwave").hide();
                        $("#playmusic").show();
                        $("#use_rec").show();
                        $("#replace_rec").show();
                        $("#stop").hide();
                        $("#use_rec").attr("onclick","savevoice();")
                        recplay(id);
                    }
                },function(s){
                    alert("录音失败："+s);
                    // batCall&&batCall();
                });
            };
        });
        function savevoice(){
            var formData = new FormData();
            formData.append("file",blob11); //传给后台
            formData.append("CID","<?=$CID?>");
            $.ajax({
                url: '?r=student/answermanage/savevoice',
                type: 'POST',
                dataType:'json',
                cache: false,
                processData: false,
                contentType: false,
                data: formData,
                success: function (data) {
                    artSaveimage('dialogForm',2);
                }
            });
        }
        function recplay(key){
            var o=recblob[key];
            console.log(o);
            if(o){
                var audio=$(".recPlay")[0];
                audio.controls=true;
                if(!(audio.ended || audio.paused)){
                    audio.pause();
                };
                o.play=(o.play||0)+1;
                var logmsg=function(msg){
                    $(".p"+key).html('<span style="color:green">'+o.play+'</span> '+new Date().toLocaleTimeString()+" "+msg);
                };
                logmsg("");

                var end=function(blob){
                    audio.src=URL.createObjectURL(blob);
                    audio.play();
                };
                var wav=Recorder[o.set.type+"2wav"];
                if(wav){
                    logmsg("正在转码成wav...");
                    wav(o.blob,function(blob){
                        end(blob);
                        logmsg("已转码成wav播放");
                    },function(msg){
                        logmsg("转码成wav失败："+msg);
                    });
                }else{
                    end(o.blob);
                };
            };
        };
        <?endif;?>
        //时间
        var min=0;
        var sec=0;
       // var ms=0;
        var timer=null;
        var count=0;
        function showtime(){

          //  ms++;
            if(sec==60){
                min++;sec=0;
            }
            // if(ms==100){
            //     sec++;ms=0;
            // }
            sec++;
            var secStr=sec;
            if(sec<10){
                secStr="0"+sec;
            }
            var minStr=min;
            if(min<10){
                minStr="0"+min;
            }
            $('#showtime span:eq(0)').html(minStr);
            $('#showtime span:eq(2)').html(secStr);
        };
    </script>
</section>

