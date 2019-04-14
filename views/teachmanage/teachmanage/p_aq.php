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
echo Html::jsFile('assets/js/recorder.mp3.min.js');
echo Html::jsFile('https://res2.wx.qq.com/open/js/jweixin-1.4.0.js');
echo Html::jsFile('assets/js/waveview.js');
?>
<style>
    body {
        background: #f5f5f5;
    }
    /*.headRight {*/
        /*height: 100%;*/
    /*}*/
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

<!-- 待回答问题列表 -->
<section class="wrap waiting_for_answer index aq">
    <section class="testTop">
        <h6>回答问题</h6>
    </section>

    <section class="adminContent">
        <form action="?r=teachmanage/teachmanage/teachsave" method="post" id="dialogForm" >
            <input type='hidden' id='_csrf' name='_csrf'  value='<?= Yii::$app->request->csrfToken ?>' />
            <input type='hidden' name='_k' value='<?=$rk?>' />
            <input type='hidden' name='vCID' value='<?=$CID?>' />
            <input type='hidden' name='vAnswerId' value='<?=pub::chkData($data,'id','')?>' />
            <input type="hidden" name="vCoin" value="<?if($data['type']==1):?><?=$data['imagecoin']?><?else:?><?=$data['voicecoin']?><?endif;?>">
            <ul>
                <li>
                    <div class="con_w">
                        <div class="w_middle">
                                <div class="w">
                                    <h4>
                                        <label><?=$data['subject']?></label>
                                        <p><?=$data['content']?></p>
                                    </h4>
                                    <div class="w_jinbi">
                                        <img class="icon_jb" src="assets/images/phone/dayi/icon_jb.png" alt="">
                                        <p><?if($data['type']==1):?><?=$data['imagecoin']?><?else:?><?=$data['voicecoin']?><?endif;?>金币</p>
                                    </div>
                                    <?if($data['type']==1):?>
                                        <img class="exam_paper" src="http://<?=$data['FilePath']?>" alt="" style="cursor:pointer; ">
                                    <?else:?>
                                        <video controls=""  name="media">
                                            <source src="http://<?=$data['FilePath']?>" type="audio/mpeg">
                                        </video>
                                    <?endif;?>
                                </div>
                        </div>
                        <div class="w_bottom">
                            <div class="a_wrap">
                                <a href="javascript:void(0)"
                                   data-url="?r=teachmanage/teachmanage/waivehead&c1=<?=pub::chkData($data,'id')?>&_k=<?=Pub::enFormMD5('edit',pub::chkData($data,'id'))?>"
                                   data-confirm='确认要放弃这道题吗？'
                                   data-id="artHead"
                                   onclick="artWaive(this);return false;"
                                >放弃本题</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="con_w">
                        <div class="w_top">
                            <div class="w">
                                <p class="color_333">文字作答</p>
                                <p class="color_999 fz01">&nbsp;&nbsp;不涉及公式，图形的题目，如语文及英语</p>
                            </div>
                        </div>
                        <div class="aq_w">
                            <div class="w">
                                <textarea name="vTeachContent" class="c-set"  cols="30" rows="4" data-chk='文字作答' placeholder="在此输入文字回答"></textarea>
                            </div>
                        </div>
                        <div class="aq_w">
                            <div class="w">
                                <h4>
                                    <p>解答图片</p>
                                    <p class="color_999 fz01">&nbsp;&nbsp;1M以内,最多上传两张图片</p>
                                </h4>
                                <section class="add_img_w">

                                </section>
                                <img id="upimage" style="cursor:pointer; " class="image_tjtp"  src="assets/images/phone/dayi/image_tjtp.png" alt="">
                            </div>
                        </div>
                        <div class="aq_w">
                            <label for="aBA">语音作答</label>
                            <div class="input_w">
                                <img class="icon_yuyin" src="assets/images/phone/dayi/icon_yuyin.png" alt="">
                                <img class="icon_choose" src="assets/images/phone/images/icon_choose.png" alt="">
                            </div>
                        </div>
                        <section class="sW_each voice">
                            <section class="wB">
                                <p id="showtime">
                                    <span>00</span>
                                    <span>:</span>
                                    <span>00</span>
                                    <span>:</span>
                                    <span>00</span>
                                </p>
                            </section>
                            <div id="playvoice" style="display: none"  >
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
<!--                                    <li id="use_rec" style="display: none;cursor:pointer;" onclick="artSaveimage('dialogForm',2)" >提交</li>-->
                                    <li id="replace_rec" style="display: none;cursor:pointer;"  >重新录音</li>
                                    <li id="stop" style="display: none;cursor:pointer;">结束录音</li>
                                </ul>
                            </section>
                        </section>
                    </div>

                </li>
            </ul>

            <button type="button" onclick="artSaveimage('dialogForm')">提交</button>
        </form>
    </section>

</section>
<script>
    $(document).on('click','#upimage',function(){
        $("#caijian").attr("src","?r=student/answermanage/caijian&type=2");
        $("#caijian").show();
    });
    $(document).on('click','.ptImgDel',function(){
        $(this).parent('div').remove();
        $("#upimage").show();
    });
    $(function () {
        $(".sW_each").show();
    })
    function artWaive(that){
        var m = $(that);
        var d = dialog({
            title:'确认提示',
            content: m.data('confirm'),
            button: [
                {
                    value: '取消',
                    callback: function () {},
                    autofocus: true
                },
                {
                    value: '确认',
                    callback: function () {
                        var url = m.data('url');
                        $.ajax({
                            url:url,
                            type: 'post',
                            data: {"_csrf":'<?= Yii::$app->request->csrfToken ?>'},
                            success: function (data) {
                                if (/\[0000\]/i.test(data)) {
                                    window.location.href ="?r=teachmanage/teachmanage/indexteach&status=1";
                                }else{
                                    showMessage(data,3,'<?=langs::getTxt('infotitle')?>');
                                }
                            }
                        });
                    }
                }
            ]
        });
        d.showModal();
    }//放弃本题
    fieldsCheck=new FieldsCheck();
    fieldsCheck.setFormat('c-s-15',"\\S{0,15}");
    fieldsCheck.setFormat('c-s-20',"\\S{0,20}");
    fieldsCheck.setFormat('c-s-30',"\\S{0,30}");
    fieldsCheck.setFormat('c-s-50',"\\S{0,50}");
    fieldsCheck.setFormat('c-s-100',"\\S{0,100}");
    fieldsCheck.setFormat('c-i-30',"\\d{0,30}");
    fieldsCheck.setFormat('c-f-2',"\\d+\\.?\\d{0,3}");//0-3位小数
    fieldsCheck.keyFire();
    function artSaveimage(formid){
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
                    <?if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')):?>
                    if($("#vWxVoice").val()!=""){
                        upqiniuwxvoice($("#vWxVoice").val());
                    }
                    <?else:?>
                    savevoice();
                    <?endif;?>
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
    <?if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')):?>
    wx.config({
        debug: false, // true开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: 'wxa9123996375fbbe7', // 必填，公众号的唯一标识
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
            e.preventDefault();
            startTime = new Date().getTime();
            //开始录音
            wx.startRecord({
                success: function () {
                    localStorage.rainAllowRecord = 'true';
                    clearInterval(timer);
                    timer = setInterval(showtime, 10)
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
            e.preventDefault();
            startTime = new Date().getTime();
            wx.startRecord({
                success: function () {
                    localStorage.rainAllowRecord = 'true';
                    min=0;
                    sec=0;
                    ms=0;
                    count=0;
                    $('#showtime span:eq(0)').html('00');
                    $('#showtime span:eq(2)').html('00');
                    $('#showtime span:eq(4)').html('00');
                    clearInterval(timer);
                    timer=setInterval(showtime,10)
                    $("#start").hide();
                   // $("#use_rec").hide();
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
                    alert((endTime - startTime) / 1000);
                    if ((endTime - startTime) / 1000 < minTime) {
                        localId = '';
                        serverId= '';
                        alert('录音少于' + minTime + '秒，录音失败，请重新录音');
                        min=0;
                        sec=0;
                        ms=0;
                        count=0;
                        $('#showtime span:eq(0)').html('00');
                        $('#showtime span:eq(2)').html('00');
                        $('#showtime span:eq(4)').html('00');
                        clearInterval(timer);
                        $("#start").show();
                        $("#stop").hide();
                    }else {
                        localId = res.localId;
                        clearInterval(timer);
                        $(".recwave").hide();
                        $("#playvoice").show();
                        //$("#use_rec").show();
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
    $(document).ready(function() {
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
            timer=setInterval(showtime,10)
            $("#start").hide();
            $("#stop").show();
            console.log("录制中...");
        };
    });
    //重新录音
    $(document).on('click','#replace_rec',function () {
        if(rec){
            rec.start();
            min=0;
            sec=0;
            ms=0;
            count=0;
            $('#showtime span:eq(0)').html('00');
            $('#showtime span:eq(2)').html('00');
            $('#showtime span:eq(4)').html('00');
            clearInterval(timer);
            timer=setInterval(showtime,10)
            $("#start").hide();
          //  $("#use_rec").hide();
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
                blob11=blob;
                var id=RandomKey(16);
                recblob[id]={blob:blob,set:$.extend({},rec.set),time:time};
                $(".recwave").hide();
                $("#playmusic").show();
              //  $("#use_rec").show();
                $("#replace_rec").show();
                $("#stop").hide();
              //  $("#use_rec").attr("onclick","savevoice();")
                recplay(id);
            },function(s){
                alert("录音失败："+s);
                // batCall&&batCall();
            });
        };
    });
    function savevoice(){
        var formData = new FormData();
        if(formData){
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

                }
            });
        }

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
    var ms=0;
    var timer=null;
    var count=0;
    function showtime(){

        ms++;
        if(sec==60){
            min++;sec=0;
        }
        if(ms==100){
            sec++;ms=0;
        }
        var msStr=ms;
        if(ms<10){
            msStr="0"+ms;
        }
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
        $('#showtime span:eq(4)').html(msStr);
    };
</script>
