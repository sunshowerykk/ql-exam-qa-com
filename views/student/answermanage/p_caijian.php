<?php
use yii\helpers\Html;
use app\models\langs;
use app\models\pub;
echo Html::cssFile('assets/caijian/examples/mui/mui.css');
echo Html::cssFile('assets/caijian/examples/common/common.css');
echo Html::cssFile('assets/caijian/dist/image-clip.css');
echo Html::cssFile('assets/caijian/examples/common/clip.css');
echo Html::jsFile('assets/caijian/examples/common/fileinput.js');
echo Html::jsFile('assets/caijian/examples/common/exif.js');
echo Html::jsFile('assets/caijian/dist/image-clip.js');
echo Html::jsFile('assets/js/jquery-1.8.1.min.js');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>图像处理</title>
</head>
<body>
<div class="clip-content">
    <div class="upload-container choose-gallery">
        <div class="upload-pretty button-three-dimen">
            <input type="file" id="targetImg">本地上传
        </div>
    </div>
    <div class="upload-container choose-camera">
        <div class="upload-pretty button-three-dimen">
            <input type="file" id="targetImgCamera" capture="camera">手机拍摄
        </div>
    </div>
    <div class="upload-container choose-close">
        <div class="upload-pretty button-three-dimen">
            <span onclick="closeifame();">关闭窗口</span>
        </div>
    </div>
    <div class="img-clip"></div>

    <nav class="clip-action nav-bar nav-bar-tab hidden">
        <a class="tab-item" id="btn-reload">
            <span class="mui-icon mui-icon-arrowleft tab-icon"></span>
            <span class="tab-label hidden">取消</span>
        </a>
        <a class="tab-item " id="btn-rotate-anticlockwise">
            <span class="mui-icon mui-icon-refreshempty tab-icon rotate90"></span>
            <span class="tab-label hidden">逆时针旋转</span>
        </a>
        <a class="tab-item " id="btn-rotate-clockwise">
            <span class="mui-icon mui-icon-refreshempty tab-icon"></span>
            <span class="tab-label hidden">顺时针旋转</span>
        </a>
        <a class="tab-item hidden" id="btn-maxrect">
            <span class="mui-icon mui-icon-navigate tab-icon"></span>
            <span class="tab-label hidden">最大选择</span>
        </a>
        <a class="tab-item" id="btn-verify">
            <span class="mui-icon mui-icon-checkmarkempty tab-icon"></span>
            <span class="tab-label hidden">确定</span>
        </a>
    </nav>
</div>

<div class="show-content hidden">
    <div class="img-wrap">
        <img class="show-img" width="50%" height="50%" data-preview-src="" data-preview-group="2"></img>
    </div>

    <nav class="nav-bar nav-bar-tab">
        <a class="tab-item" id="btn-back">
            <span class="mui-icon mui-icon-arrowleft tab-icon"></span>
            <span class="tab-label hidden">取消</span>
        </a>
        <a class="tab-item" id="btn-detail">
            <span class="mui-icon mui-icon-more-filled tab-icon"></span>
            <span class="tab-label hidden">详情</span>
        </a>
        <a class="tab-item" id="btn-save">
            <span class="mui-icon mui-icon-checkmarkempty tab-icon"></span>
            <span class="tab-label hidden">确定</span>
        </a>
    </nav>
</div>
<script>
    function closeifame() {
        $("#caijian",window.parent.document).hide();
    }
    var chooseGallery;
    var chooseCamera;
    var cropImage;
    var imgData;
    var clipContent;
    var clipAction;
    var showContent;
    var showImg;
    var targetImg;
    var targetImgCamera;

    initPage();

    function initPage() {
        initParams();
        initListeners();
        initImgClip();
    }

    function initParams() {
        targetImg = document.querySelector('#targetImg');
        targetImgCamera = document.querySelector('#targetImgCamera');
        chooseGallery = document.querySelector('.choose-gallery');
        chooseCamera = document.querySelector('.choose-camera');
        clipContent = document.querySelector('.clip-content');
        clipAction = document.querySelector('.clip-action');
        showContent = document.querySelector('.show-content');
        showImg = document.querySelector('.show-img');
    }

    function initImgClip() {
        new FileInput({
            container: '#targetImg',
            isMulti: false,
            type: 'Image_Camera',
            success: function(b64, file, detail) {
                // console.log("选择:" + b64);
                console.log("fileName:" + file.name);

                loadImg(b64);
            },
            error: function(error) {
                console.error(error);
            }
        });
        new FileInput({
            container: '#targetImgCamera',
            isMulti: false,
            type: 'Camera',
            success: function(b64, file, detail) {
                // console.log("选择:" + b64);
                console.log("fileName:" + file.name);
                loadImg(b64);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function loadImg(b64) {
        changeImgClipShow(true);

        var img = new Image();
        img.src = b64;

        img.onload = function() {
            EXIF.getData(img, function() {
                var orientation = EXIF.getTag(this, 'Orientation');

                cropImage && cropImage.destroy();
                cropImage = new ImageClip({
                    container: '.img-clip',
                    img,
                    // 0代表按下才显示，1恒显示，-1不显示
                    sizeTipsStyle: 0,
                    // 为1一般是屏幕像素x2这个宽高
                    // 最终的大小为：屏幕像素*屏幕像素比（手机中一般为2）*compressScaleRatio
                    compressScaleRatio: 1.1,
                    // iphone中是否继续放大：x*iphoneFixedRatio
                    // 最好compressScaleRatio*iphoneFixedRatio不要超过2
                    iphoneFixedRatio: 1.8,
                    // 减去顶部间距，底部bar,以及显示间距
                    maxCssHeight: window.innerHeight - 100 - 50 - 20,
                    // 放大镜捕获的图像半径
                    captureRadius: 30,
                    // 是否采用原图像素（不会压缩）
                    isUseOriginSize: false,
                    // 增加最大宽度，增加后最大不会超过这个宽度
                    maxWidth: 0,
                    // 是否固定框高，优先级最大，设置后其余所有系数都无用直接使用这个固定的宽，高度自适应
                    forceWidth: 0,
                    // 同上，但是一般不建议设置，因为很可能会改变宽高比导致拉升，特殊场景下使用
                    forceHeight: 0,
                    // 压缩质量
                    quality: 0.92,
                    mime: 'image/jpeg',
                });

                // 6代表图片需要顺时针修复（默认逆时针处理了，所以需要顺过来修复）
                switch (orientation) {
                    case 6:
                        cropImage.rotate(true);
                        break;
                    default:
                        break;
                }

            });
        };
    }

    function resizeShowImg(b64) {
        var img = new Image();

        img.src = b64;
        img.onload = showImgOnload;
    }

    function showImgOnload() {
        // 必须用一个新的图片加载，否则如果只用showImg的话永远都是第1张
        // margin的话由于有样式，所以自动控制了
        var width = this.width;
        var height = this.height;
        var wPerH = width / height;
        var MAX_WIDTH = Math.min(window.innerWidth, width);
        var MAX_HEIGHT = Math.min(window.innerHeight - 50 - 100, height);
        var legalWidth = MAX_WIDTH;
        var legalHeight = legalWidth / wPerH;

        if (MAX_WIDTH && legalWidth > MAX_WIDTH) {
            legalWidth = MAX_WIDTH;
            legalHeight = legalWidth / wPerH;
        }
        if (MAX_HEIGHT && legalHeight > MAX_HEIGHT) {
            legalHeight = MAX_HEIGHT;
            legalWidth = legalHeight * wPerH;
        }

        var marginTop = (window.innerHeight - 50 - legalHeight) / 2;

        showImg.style.marginTop = marginTop + 'px';
        showImg.style.width = legalWidth + 'px';
        showImg.style.height = legalHeight + 'px';
    }

    function changeImgClipShow(isClip) {
        if (isClip) {
            chooseGallery.classList.add('hidden');
            chooseCamera.classList.add('hidden');
            clipAction.classList.remove('hidden');
        } else {
            chooseGallery.classList.remove('hidden');
            chooseCamera.classList.remove('hidden');
            clipAction.classList.add('hidden');
            // 需要改变input，否则下一次无法change
            targetImg.value = '';
            targetImgCamera.value = '';
        }
    }

    function initListeners() {
        document.querySelector('#btn-reload').addEventListener('click', function() {
            cropImage && cropImage.destroy();
            changeImgClipShow(false);
        });
        document.querySelector('#btn-back').addEventListener('click', function() {
            changeContent(false);
        });
        document.querySelector('#btn-save').addEventListener('click', function() {
            // downloadFile(imgData);
            upload(function() {
                <?if($type==1):?>
                $("#pic64",window.parent.document).attr("value",imgData);
                $("#upimage",window.parent.document).hide();
                $("#upimg",window.parent.document).show();
                $("#imgdata",window.parent.document).attr("src",imgData);
                tips('上传成功');
                changeImgClipShow(false);
                changeContent(false);
                cropImage && cropImage.destroy();
                $("#caijian",window.parent.document).hide();
                <?else:?>
               var imglength= $(".imgupup",window.parent.document).length
                if(imglength==0){
                    $(".add_img_w",window.parent.document).append('<div class="ptImg"><img  class="image_tjtp imgupup"  src="'+imgData+'" alt=""><img  class="ptImgDel" src="assets/images/dayi/icon_close.png" style="cursor:pointer; "><input name="pic64[]" type="hidden" value="'+imgData+'"></div>');
                }else if(imglength==1){
                    $(".add_img_w",window.parent.document).append('<div class="ptImg"><img  class="image_tjtp imgupup"  src="'+imgData+'" alt=""><img  class="ptImgDel" src="assets/images/dayi/icon_close.png" style="cursor:pointer; "><input name="pic64[]" type="hidden" value="'+imgData+'"></div></div>');
                    $("#upimage",window.parent.document).hide();
                }
                // $("#pic64",window.parent.document).attr("value",imgData);
                // $("#upimage",window.parent.document).hide();
                // $("#upimg",window.parent.document).show();
                // $("#imgdata",window.parent.document).attr("src",imgData);
                // tips('上传成功');
                 changeImgClipShow(false);
                 changeContent(false);
                 cropImage && cropImage.destroy();
                $("#caijian",window.parent.document).hide();
                <?endif;?>
            });
        });
        document.querySelector('#btn-detail').addEventListener('click', function() {
            showImgDataLen(imgData);
        });

        document.querySelector('#btn-maxrect').addEventListener('click', function() {
            if (!cropImage) {
                tips('请选择图片');
                return;
            }
            cropImage.resetClipRect();
        });

        document.querySelector('#btn-rotate-anticlockwise').addEventListener('click', function() {
            if (!cropImage) {
                tips('请选择图片');
                return;
            }
            cropImage.rotate(false);
        });

        document.querySelector('#btn-rotate-clockwise').addEventListener('click', function() {
            if (!cropImage) {
                tips('请选择图片');
                return;
            }
            cropImage.rotate(true);
        });

        document.querySelector('#btn-verify').addEventListener('click', function() {
            if (!cropImage) {
                tips('请选择图片');
                return;
            }

            var isConfirm = confirm("是否裁剪图片并处理？");

            if (isConfirm) {
                cropImage.clip(false);
                imgData = cropImage.getClipImgData();
                recognizeImg(function() {
                    changeContent(true);
                }, function(error) {
                    tips(JSON.stringify(error), true);
                });
            }

        });
    }

    function showImgDataLen(imgData) {
        var len = imgData.length;
        var sizeStr = len + 'B';

        if (len > 1024 * 1024) {
            sizeStr = (Math.round(len / (1024 * 1024))).toString() + 'MB';
        } else if (len > 1024) {
            sizeStr = (Math.round(len / 1024)).toString() + 'KB';
        }

        tips('处理后大小：' + sizeStr);
    }

    function tips(msg, isAlert) {
        if (isAlert) {
            alert(msg);
        } else {
            toast(msg);
        }
    }

    function toast(message) {
        var CLASS_ACTIVE = 'mui-active';
        var duration = 2000;
        var toastDiv = document.createElement('div');

        toastDiv.classList.add('mui-toast-container');
        toastDiv.innerHTML = `<div class="mui-toast-message">${message}</div>`;
        toastDiv.addEventListener('webkitTransitionEnd', () => {
            if (!toastDiv.classList.contains(CLASS_ACTIVE)) {
            toastDiv.parentNode.removeChild(toastDiv);
            toastDiv = null;
        }
    });
        // 点击则自动消失
        toastDiv.addEventListener('click', () => {
            toastDiv.parentNode.removeChild(toastDiv);
        toastDiv = null;
    });
        document.body.appendChild(toastDiv);
        toastDiv.classList.add(CLASS_ACTIVE);
        setTimeout(function() {
            toastDiv && toastDiv.classList.remove(CLASS_ACTIVE);
        }, duration);
    }

    function changeContent(isShowContent) {
        if (isShowContent) {
            showContent.classList.remove('hidden');
            clipContent.classList.add('hidden');

            resizeShowImg(imgData);
            showImg.src = imgData;

        } else {
            showContent.classList.add('hidden');
            clipContent.classList.remove('hidden');
        }
    }

    function b64ToBlob(urlData) {
        var arr = urlData.split(',');
        var mime = arr[0].match(/:(.*?);/)[1] || 'image/png';
        // 去掉url的头，并转化为byte
        var bytes = window.atob(arr[1]);

        // 处理异常,将ascii码小于0的转换为大于0
        var ab = new ArrayBuffer(bytes.length);
        // 生成视图（直接针对内存）：8位无符号整数，长度1个字节
        var ia = new Uint8Array(ab);
        for (var i = 0; i < bytes.length; i++) {
            ia[i] = bytes.charCodeAt(i);
        }

        return new Blob([ab], {
            type: mime
        });
    }

    function downloadFile(content) {
        // Convert image to 'octet-stream' (Just a download, really)
        var imageObj = content.replace("image/jpeg", "image/octet-stream");
        window.location.href = imageObj;
    }

    function recognizeImg(success, error) {
        // 里面正常有：裁边，摆正，梯形矫正，锐化等算法操作
        success();
    }

    function upload(success, error) {
        success();
    }
</script>
</body>

</html>
