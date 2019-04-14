<?php
namespace app\controllers\student; //basic 二级目录控制器
use Yii;
use yii\db\Exception;
use app\core\base\BaseController;
use app\models\langs;
use app\models\pub;
use app\models\cupage;
use crazyfd\qiniu\Qiniu;
use yii\debug\models\search\Db;


class AnswermanageController extends BaseController
{
    public $ak = 'bRfl2x63mooBtipUfCAL0ia7_twu7-L3Usv14Ck4';
    public $sk = 'sxLjrxpoNlaJ0VzmCbNWLAIA5G667_5JKM_UQ3ku';
    public $domain = 'pm4gmozbu.bkt.clouddn.com';//在https://portal.qiniu.com/bucket/bucket/index页面查看
    public $bucket='exam';
    public $zone='east_china';
    public function beforeAction($action)
    {
        return $this->renderContent(langs::get('noright'));
        return true;
    }

    public function actions()
    { //默认执行动作
        parent::actions();//调用父方法
    }

    public function actionIndex()
    {
        parent::actionIndex();//调用父方法
        if (pub::is_mobile()) {
            $this->layout = "mainphone";
        } else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data'] = "10";
        $sql="select a.*,b.FileId,b.FilePath from sys_subject a left join sys_file b on a.CID=b.FileId order by a.id";
        $subject=Yii::$app->db->createCommand($sql)->queryAll();
       // file_put_contents('D:/log/l' . time() . '.txt', print_r(yii::$app->session['studentuser']['gold'], true), FILE_APPEND);
        $part = array(
            'subject'=>$subject
        );
        if (pub::is_mobile()) {
            return $this->render('p_index', $part);
        } else {
            return $this->render('index', $part);
        }
    }
    public function actionFindquestion($p='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $subjectid = $req->get('subjectid','');
        $where = " where 1=1 and a.status =2";
        if(!empty($subjectid)){
            $subjectid=trim($subjectid); /*去除变量所以空格*/
            $where .=" and a.subjectid =$subjectid";
        }
        $perNumber=10; //每页显示的记录数
        $sql = "SELECT count(1) FROM sys_answer a $where ";
        //print_r($sql);
        $count=Yii::$app->db->createCommand($sql)->queryScalar();
        $totalNumber=$count;
        $total_pages=ceil($totalNumber/$perNumber); //计算出总页数
        //接受的分页数 $page（P）大于总页数，赋值成总页数
        $page = $page>$total_pages?$total_pages:$page;

        //$page 如果没有值,则赋值1
        $startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
        $startCount = $startCount<0?0:$startCount;
        $part= array(
            'total_rows'=>$totalNumber, #(必须)
            'method'    =>'ajax', #(必须)
            'ajax_func_name'=>'findquestion',
            'parameter'=>$subjectid,  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select a.*,b.subject,b.voicecoin,b.imagecoin,c.type as filetype,c.FilePath from sys_answer a left join sys_subject b on a.subjectid=b.id 
                    left join sys_file c on a.cid = c.FileId
                    $where order by a.intime DESC limit $startCount,$perNumber ";
        //  print_r ($sql);
        $d_data = Yii::$app->db->createCommand($sql)->queryAll();
        //返回值处理或调用模板
        $part = array(
            'd_data'=>$d_data,
            'page'=>$pages,
            'rK'=>pub::enFormMD5('add','')
        );
        if ( pub::is_mobile() ) {
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('p_findquestion',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findquestion',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findquestion',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findquestion',$part); //不调用layout
            }
        }
    }
    public function actionFindmyquestion($p='1',$status='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $status = $req->get('status',$status);
        $userid=yii::$app->session['studentuser']['userid'];
        $where = " where 1=1 and a.status =".$status." and a.userid=".$userid;
        $perNumber=10; //每页显示的记录数
        $sql = "SELECT count(1) FROM sys_answer a $where ";
        //print_r($sql);
        $count=Yii::$app->db->createCommand($sql)->queryScalar();
        $totalNumber=$count;
        $total_pages=ceil($totalNumber/$perNumber); //计算出总页数
        //接受的分页数 $page（P）大于总页数，赋值成总页数
        $page = $page>$total_pages?$total_pages:$page;

        //$page 如果没有值,则赋值1
        $startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
        $startCount = $startCount<0?0:$startCount;
        $part= array(
            'total_rows'=>$totalNumber, #(必须)
            'method'    =>'ajax', #(必须)
            'ajax_func_name'=>'findmyquestion',
            'parameter'=>$status,  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select a.*,b.subject,b.voicecoin,b.imagecoin,c.type as filetype,c.FilePath from sys_answer a left join sys_subject b on a.subjectid=b.id 
                    left join sys_file c on a.cid = c.FileId
                    $where order by a.intime DESC limit $startCount,$perNumber ";
        //  print_r ($sql);
        $d_data = Yii::$app->db->createCommand($sql)->queryAll();
        //返回值处理或调用模板
        $part = array(
            'd_data'=>$d_data,
            'page'=>$pages,
            'rK'=>pub::enFormMD5('add','')
        );
        if ( pub::is_mobile() ) {
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('p_findmyquestion',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findmyquestion',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findmyquestion',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findmyquestion',$part); //不调用layout
            }
        }
    }
    public function actionQuestiondetail()//
    {
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $cId = $req->get('c1','');
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $sql="select a.*,b.FileId,b.FilePath,c.voicecoin,c.imagecoin,c.subject from sys_answer a left join sys_file b on a.cid=b.FileId 
              left join sys_subject c on a.subjectid=c.id where a.id='$cId' ";
        $data=Yii::$app->db->createCommand($sql)->queryOne();
        $sql="select a.*,c.FilePath as headimg from sys_teachanswerd a left join  sys_user b on a.teachid=b.id left join sys_file c on b.CID=c.FileId where a.answerid ='$cId' limit 1";
        $teachdata=Yii::$app->db->createCommand($sql)->queryOne();
        $sql="select type,FilePath from sys_file where FileId='".$teachdata['cid']."'";
        $teachfile=Yii::$app->db->createCommand($sql)->queryAll();
        $teachdata['teachfile']=$teachfile;
        $data['teach']=$teachdata;
        $view = Yii::$app->view->params['data']="10";
        $part = array(
            'data'=> $data
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_questiondetail', $part);
        }else {
            return $this->render('questiondetail', $part);
        }
    }
    public function actionIndexdetail()//答疑收支管理
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="10";
        $part = array(

        );
        if ( pub::is_mobile() ) {
            return $this->render('p_indexdetail', $part);
        }else {
            return $this->render('indexdetail', $part);
        }
    }

    public function actionCaijian()//答疑收支管理
    {
        $req = Yii::$app->request;
        $type=$req->get('type','');
        parent::actionIndex();//调用父方法
        $part = array(
            'type'=>$type
        );
     return $this->render('p_caijian', $part);
    }
    public function actionCreatequestion()//答疑收支管理
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="10";
        $cCID =pub::guid();
        $json = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxa9123996375fbbe7&secret=59d3a91f00163846d83292a9ef7c5dd8");
        //echo $json;
        //exit();
        $arr = json_decode($json,true);
        $token = $arr['access_token'];
        //file_put_contents('D:/log/l' . time() . '.txt', print_r($token, true), FILE_APPEND);
        $json2 = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$token."&type=jsapi");
        //echo $json;
        $arr2 = json_decode($json2,true);//获取ticket
        $ticket=$arr2['ticket'];
        $host='https://'.$_SERVER['HTTP_HOST'];
        $noncestr = "75riJbhax1ixrdkD";
        $timestamp = time();
        if($_SERVER['QUERY_STRING']) {
            $url = 'https://'.$_SERVER['HTTP_HOST'].'/?'. $_SERVER['QUERY_STRING'];
        }else{
            $url = 'https://'.$_SERVER['HTTP_HOST'];
        }
        // file_put_contents('D:/log/l' . time() . '.txt', print_r($url, true), FILE_APPEND);
        $str="jsapi_ticket=".$ticket."&noncestr=".$noncestr."&timestamp=".$timestamp."&url=".$url;
        $signature = sha1($str);

        $sql="select * from sys_subject order by id";
        $subject=Yii::$app->db->createCommand($sql)->queryAll();
        // $json3 = file_get_contents("https://api.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=".$token."&media_id=bXHpyJsss-bIzxVo3Mhr6v29ujVwjhxCkZIPnEp3jan560ltF_cH6JV3dH7UUGIA");
        // $arr3 = json_decode($json3,true);

        $part = array(
            'subject'=>$subject,
            'CID'=>$cCID,
            "host"=>$host,
            "timestamp"=>$timestamp,
            "noncestr"=>$noncestr,
            "signature"=>$signature,
            'rp'=>1,
            'rop'=>"add",
            'rk'=>pub::enFormMD5('add')

        );
        if ( pub::is_mobile() ) {
            return $this->render('p_createquestion', $part);
        }else {
            return $this->render('createquestion', $part);
        }
    }
    public function actionChenkgold($cSubjectId,$cType){
        $sql="select * from sys_subject where id='$cSubjectId'";
        $subject=Yii::$app->db->createCommand($sql)->queryOne();
        if($cType==1){
            $gold=$subject['imagecoin'];
        }else{
            $gold=$subject['voicecoin'];
        }
        if(yii::$app->session['studentuser']['gold']>=$gold){
            $curl = curl_init(); // 启动一个CURL会话
            $data=array(
                'access-token' => yii::$app->session['access-token'],
                'gold'=>$gold
            );
            // $data2= json_encode($data);
            curl_setopt($curl, CURLOPT_URL, "https://api.kaoben.top/user/reduce-gold"); // 要访问的地址
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
            curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
            curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
            curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
            curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
            $tmpInfo = curl_exec($curl); // 执行操作
            if (curl_errno($curl)) {
                echo 'Errno'.curl_error($curl);//捕抓异常
            }
            curl_close($curl); // 关闭CURL会话
            $golddata=json_decode($tmpInfo,true);
        }else{
            $golddata['status']=3;
            $golddata['message']="金币不足！";
        }
        return $golddata;
    }
    public function actionSavequestion(){    //新加保存
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        if (!$req->isPost){
            $r = '非法提交，无法使用！!';
            return $this->renderContent($r);
        }
        $r = "[0000]";
        $pic64=$req->post("pic64","");
        $cId=$req->post("vId","");
        $cP = $req->post('vP',"");
        $cCID = $req->post('vCID',"");
        $cSubjectId = $req->post('vSubjectId',"");
        $cType = $req->post('vType',"");
       // $cWxVoice = $req->post('vWxVoice',"");
        $cContent = $req->post('vContent',"");
        $golddata=$this->actionChenkgold($cSubjectId,$cType);
        if($golddata['status']==0){
            $studentuser=yii::$app->session['studentuser'];
            $studentuser['gold']=$golddata['gold'];
            yii::$app->session['studentuser']=$studentuser;
        }elseif($golddata['status']=='-1'){
            $r = $golddata['message'];
            return $this->renderContent($r);
        }elseif ($golddata['status']=='-2'){
            $r = $golddata['message'];
            return $this->renderContent($r);
        }elseif ($golddata['status']=='3'){
            $r = $golddata['message'];
            return $this->renderContent($r);
        }
        $ck=$req->post('_k','');
        $cadd=pub::enFormMD5("add");
        $cedit=pub::enFormMD5("edit",$cId);
        if(!empty($pic64)){
            $this->actionUploadqiniu($cCID,$pic64);
        }
        $tra1 = Yii::$app->db->beginTransaction();
        try {
            if (!$req->isPost){
                $r = '非法提交，无法使用！';
                throw new Exception($r);
            }
            if ($ck==$cadd) { //增加
                try {
                    $data = array(
                        'cid'=>$cCID,
                        'subjectid'=>$cSubjectId,
                        'type' => $cType,
                        'content'    =>$cContent,
                        'userid'=>yii::$app->session['studentuser']['userid'],
                        'username'=>yii::$app->session['studentuser']['username'],
                        'intime'=>date('Y-m-d H:i:s',time()),
                    );
                    $ts = Yii::$app->db->createCommand()->insert('sys_answer', $data)->execute();
                    $tra1->commit();
                }catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "新增保存失败！";
                    throw new Exception($r);
                }
            } elseif ($ck==$cedit) { //修改保存
                try {
                    $data = array(
                        'subjectid'=>$cSubjectId,
                    );
                    $ts=Yii::$app->db->createCommand()->update('sys_answer', $data, ['id' => $cId])->execute();
                    $tra1->commit();
                } catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "新增保存失敗請重試再联络技术专员！";
                    throw new Exception($r);
                }
            } else { //验证失败，不能保存
                $r = langs::get('checkerror');
                throw new Exception($r);
            }
        } catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = $e->getMessage();
        }
        $res='{"_code":"'.$r.'"';
        $res.='}';
        //返回值处理或调用模板
        if ($req->isAjax){ //ajax提交
            return $this->renderContent($res);
        }else{   //普通提交
            return $this->render('add');
        }
    }
    public function actionMyquestion()//答疑收支管理
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="10";
        $part = array(

        );
        if ( pub::is_mobile() ) {
            return $this->render('p_myquestion', $part);
        }else {
            return $this->render('myqusetion', $part);
        }
    }
    public function actionUploadqiniu($cid="",$file="")
    {
        $req = Yii::$app->request;
        $cCId = $req->get('c1',$cid);
      //  $ctype = $req->get('type',$file);
        $this->layout = 0; //不调用layout模板
        $qiniu = new Qiniu($this->ak,$this->sk,$this->domain, $this->bucket,$this->zone);//所属地区 华东east_china(默认),华北north_china,华南south_china,北美north_america
        $key = time();
        $imageName = $key.'.png';
        $path = "./Data";
        if (!is_dir($path)){ //判断目录是否存在 不存在就创建
            mkdir($path,0777,true);
        }
        if (strstr($file,",")){
            $image = explode(',',$file);
            $image = $image[1];
        }
        $imageSrc= $path."/". $imageName; //图片名字
        $r = file_put_contents($imageSrc, base64_decode($image));//返回的是字节数
        if ($r) {
                    $qiniu->uploadFile($imageSrc, $key);
                    $url = $qiniu->getLink($key);//图片的url
            $tra1 = Yii::$app->db->beginTransaction();
                    if(!empty($url)){
                        $data = array(
                            'key'=>$key,
                            'FileId' => $cCId,
                            'FileExtension' => '',
                            'FilePath'=>$url,
                            'InTime'=>date('Y-m-d',time()),
                            'InUser'=>yii::$app->session['studentuser']['username']
                        );
                        try{ //提交错误
                            Yii::$app->db->createCommand()->insert('sys_file', $data)->execute();
                            $tra1->commit();
                            unlink($imageSrc);
                        }catch (Exception $e){
                            pub::wrlog($e->getMessage());
                            $r = "保存失败请稍后重试！";
                            throw new Exception($r);
                        }
                    }
             }
        }
    public function actionUploadqiniuteach()
    {
        $req = Yii::$app->request;
        $cCId = $req->get('c1','');
        //  $ctype = $req->get('type',$file);
        $this->layout = 0; //不调用layout模板
        $qiniu = new Qiniu($this->ak,$this->sk,$this->domain, $this->bucket,$this->zone);//所属地区 华东east_china(默认),华北north_china,华南south_china,北美north_america
        $key = time();
            $qiniu->uploadFile($_FILES['file']['tmp_name'], $key);
            $url = $qiniu->getLink($key);//图片的url
        $tra1 = Yii::$app->db->beginTransaction();
            if(!empty($url)){
                $data = array(
                    'key'=>$key,
                    'FileId' => $cCId,
                    'FileExtension' => '',
                    'FilePath'=>$url,
                    'InTime'=>date('Y-m-d',time()),
                    'InUser'=>Yii::$app->user->identity->UserName
                );
                try{ //提交错误
                    Yii::$app->db->createCommand()->insert('sys_file', $data)->execute();
                    $tra1->commit();
                }catch (Exception $e){
                    pub::wrlog($e->getMessage());
                    $r = "保存失败请稍后重试！";
                    throw new Exception($r);
                }
            }
        echo json_encode(array("error" => "0", "pic" => "http://".$url,"uid" =>$cCId,"key"=>$key));
        }
    public function actionDeluphead(){    //删除 ajax提交自己加参数判断
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $UId=$req->post('uid','');
        $key=$req->post('key','');
        $r = "1";
        if (!$req->isPost){
            $r = '非法提交，无法使用！';
            return $this->renderContent($r);
        }
        $tra1 = Yii::$app->db->beginTransaction();
        try {
            $where = array(
                'FileId' => $UId,
            );
            // file_put_contents('E:/log/l'.time().'.txt', print_r($where, true), FILE_APPEND);
            $ts=Yii::$app->db->createCommand()->delete('sys_file', $where)->execute();
            //要刪除實體文件，
            if($ts==1){
                $qiniu = new Qiniu($this->ak, $this->sk,$this->domain, $this->bucket,$this->zone);//所属地区 华东east_china(默认),华北north_china,华南south_china,北美north_america
                $qiniu->delete($key,$this->bucket);
            }
            $tra1->commit();
        } catch (Exception $e) {
            pub::wrlog($e->getMessage());
            $r = "删除失败请重试或者联系开发人员！";
            throw new Exception($r);
        }
        return $this->renderContent($r);
    }
    public function actionSavevoice(){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $qiniu = new Qiniu($this->ak,$this->sk,$this->domain, $this->bucket,$this->zone);//所属地区 华东east_china(默认),华北north_china,华南south_china,北美north_america
        $cCId=$req->post('CID','');
        $key = time();
        if (isset($_POST)) {
            $qiniu->uploadFile($_FILES['file']['tmp_name'], $key);
            $url = $qiniu->getLink($key);//图片的url
            if (!empty($url)) {
                $data = array(
                    'key' => $key,
                    'FileId' => $cCId,
                    'FileExtension' => '',
                    'FilePath' => $url,
                    'type' => 2,
                    'InTime' => date('Y-m-d', time()),
                    'InUser' => yii::$app->session['studentuser']['username']
                );
                try { //提交错误
                    Yii::$app->db->createCommand()->insert('sys_file', $data)->execute();
                } catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "保存失败请稍后重试！";
                    throw new Exception($r);
                }
            }
        }
    }
    public function actionGetteachbyid(){
        $req = Yii::$app->request;
        $id=$req->get('id','');
        $this->layout = 0; //不调用layout模板
        $sql="select a.teachname,c.FilePath,b.UserInfo ,count(*) as count ,sum(a.rank) as score  from sys_teachanswerd a LEFT JOIN sys_user b
            ON a.teachid=b.id LEFT JOIN sys_file c ON b.CID =c.FileId where teachid ='$id' GROUP BY a.teachid";
        $d_data = Yii::$app->db->createCommand($sql)->queryOne();

        if(!empty($d_data)){
            echo json_encode(array('code'=>200,'data'=>$d_data));
        }else{
            echo json_encode(array('code'=>400));
        }

    }
    public function actionUpqiniuwxvoice(){
        $req = Yii::$app->request;
        $cWxVoice=$req->post('WxVoice','');
        $cCID=$req->post('CID','');
        $json = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx304ce55c64a3cbe7&secret=3aa4c57548d6ba6269f8a9569537a75d");
        //echo $json;
        //exit();
        $arr = json_decode($json,true);
        $token = $arr['access_token'];
//            $path = "./weixinrecord/";   //保存路径，相对当前文件的路径
//            if(!is_dir($path)){
//                mkdir($path);
//            }
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$token."&media_id=".$cWxVoice;
        $encodedURL = str_replace(array('+', '/'), array('-', '_'), base64_encode($url));
        $encodedEntryURI = str_replace(array('+', '/'), array('-', '_'), base64_encode($this->bucket));
        $url = '/fetch/' . $encodedURL . '/to/' . $encodedEntryURI;
        $sign = hash_hmac('sha1', $url . "\n", $this->sk, true);
        $token = $this->ak . ':' . str_replace(array('+', '/'), array('-', '_'), base64_encode($sign));
        $header = array('Host: iovip.qbox.me', 'Content-Type:application/x-www-form-urlencoded', 'Authorization: QBox ' . $token);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, trim('http://iovip.qbox.me' . $url, '\n'));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "");
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);//fetch微信语音
        //并将微信语音转码
        if(!empty($result['key'])){
            $notifyURL="http://". $_SERVER['SERVER_NAME']."?r=apitest/getqiniu&cid=".$cCID;
            $data = 'bucket=' . $this->bucket . '&key=' . $result['key'] . '&fops=' . urlencode('avthumb/mp3/ar/44100/aq/3') . '&notifyURL='.urlencode($notifyURL);
            //   file_put_contents('D:/log/l'.time().'.txt', print_r($data, true), FILE_APPEND);
            $sign = hash_hmac('sha1', "/pfop/\n" . $data, $this->sk, true);
            $token = $this->ak . ':' . str_replace(array('+', '/'), array('-', '_'), base64_encode($sign));
            $header = array('Content-Type:application/x-www-form-urlencoded', 'Authorization: QBox ' . $token);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://api.qiniu.com/pfop/');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $result = json_decode(curl_exec($curl), true);
            curl_close($curl);
        }
//        sleep(5);
//        //转码成功用id拿取信息
//        if(!empty($result['persistentId'])){
//            $url="https://api.qiniu.com/status/get/prefop?id=".$result['persistentId']."&ref=developer.qiniu.com";
//            $curl = curl_init();
//            curl_setopt($curl, CURLOPT_URL, $url);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($curl, CURLOPT_HEADER, 0);
//            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
//            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//            $result = json_decode(curl_exec($curl), true);
//            curl_close($curl);
//        }
    }
    public function actionRankhead(){    //删除 ajax提交自己加参数判断
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        $r = "[0000]";
        if (!$req->isPost){
            $r = '非法提交，无法使用！';
            return $this->renderContent($r);
        }
        $c1= $req->get('c1',"");
        $rank=$req->post('rank','');
        //删除信息
        $tra1 = Yii::$app->db->beginTransaction();
        try{
            $data=array(
                'rank'=>$rank,
            );
            Yii::$app->db->createCommand()->update('sys_teachanswerd', $data, ['id' => $c1])->execute();
            $tra1->commit();
        }catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = "评价失败！";
        }
        return $this->renderContent($r);
    }
}
