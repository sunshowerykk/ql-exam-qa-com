<?php
namespace app\controllers\teachmanage; //basic 二级目录控制器
use Yii;
use yii\db\Exception;
use app\core\base\BaseController;
use app\models\langs;
use app\models\pub;
use app\models\cupage;
use crazyfd\qiniu\Qiniu;
use yii\debug\models\search\Db;

class TeachmanageController extends BaseController
{
    public $ak = 'BpA5RUTf1eWdiDpsRrosEJ-i9CroZjj9Gi4NOw5t';
    public $sk = 'errjOOqxbwghY96t1a4bSP-ERR-42bHqEI_4H-15';
    public $domain = 'sd.answer.kaoben.top';//在https://portal.qiniu.com/bucket/bucket/index页面查看
    public $bucket='sd-ben-answer';
    public $zone='north_china';
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

        $part = array();
        if (pub::is_mobile()) {
            return $this->render('p_index', $part);
        } else {
            return $this->render('index', $part);
        }
    }
    public function actionIndexteach(){
        parent::actionIndex();//调用父方法

        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }

        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="10";
        $req = Yii::$app->request;
        $status=$req->get('status','');
        $teachid=Yii::$app->user->identity->id;
        $sql="select AnswerSubject from sys_user where id='$teachid'";
        $subjectid=Yii::$app->db->createCommand($sql)->queryScalar();
        foreach (explode(",",$subjectid) as $v){
            if(!empty($v))
            $sql="select a.*,b.FileId,b.FilePath from sys_subject a left join sys_file b on a.CID=b.FileId where a.id='$v'";
            $subject[]=Yii::$app->db->createCommand($sql)->queryOne();
        }
//        $sql="select * from sys_subject order by id";
//        $subject=Yii::$app->db->createCommand($sql)->queryAll();
        $part = array(
            'subjectid'=>$subjectid,
            'status'=>$status,
            'subject'=>$subject
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_indexteach', $part);
        }else {
            return $this->render('indexteach', $part);
        }
    }
    public function actionFindteach($p='1',$subjectid){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $status = $req->get('status','');
        $subjectid = $req->get('subjectid',$subjectid);
        $teachid=Yii::$app->user->identity->id;
        $cYear = $req->post('qYear','');
        $cMonth = $req->post('qMonth','');
        $where = " where 1=1 and a.status=".$status ;
        if(!empty($subjectid)){
            $subjectid=trim($subjectid); /*去除变量所以空格*/
            $where .=" and a.subjectid in ($subjectid) ";
        }
        if(!empty($cYear)){
            $cYear=trim($cYear); /*去除变量所以空格*/
            $where .=" and left(a.intime,4) =$cYear";
        }
        if(!empty($cMonth)){
            $cMonth=trim($cMonth); /*去除变量所以空格*/
            $where .=" and SUBSTR(a.intime,6,2)=$cMonth";
        }
        if($status==2){
            if(!empty($teachid)){
                $teachid=trim($teachid); /*去除变量所以空格*/
                $where .=" and a.teachid=$teachid";
            }
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
            $d_data = Yii::$app->db->createCommand($sql)->queryAll();
        //返回值处理或调用模板
        $part = array(
            'd_data'=>$d_data,
            'page'=>$pages,
            'rK'=>pub::enFormMD5('add','')
        );
        if ( pub::is_mobile() ) {
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('p_findteach',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findteach',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findteach',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findteach',$part); //不调用layout
            }
        }
    }
    public function actionFindteach2()//
    {

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
            return $this->render('p_findteach2', $part);
        }else {
            return $this->render('findteach2', $part);
        }
    }
    public function actionIndexpay()//答疑收支管理
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
            return $this->render('p_indexpay', $part);
        }else {
            return $this->render('indexpay', $part);
        }
    }
    public function actionFindpay($p='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $cYear = $req->post('qYear','');
        $cMonth = $req->post('qMonth','');
        $teachid=Yii::$app->user->identity->id;
        $where = " where 1=1 and teachid=".$teachid;
        if(!empty($cYear)){
            $cYear=trim($cYear); /*去除变量所以空格*/
            $where .=" and left(date,4) =$cYear";
        }
        if(!empty($cMonth)){
            $cMonth=trim($cMonth); /*去除变量所以空格*/
            $where .=" and right(date,2) =$cMonth";
        }
        $perNumber=10; //每页显示的记录数
        $sql = "SELECT count(1) FROM sys_teachpay  $where ";
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
            'ajax_func_name'=>'findpay',
            'parameter'=>"",  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select * from sys_teachpay
                    $where order by indate DESC limit $startCount,$perNumber ";
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
                return $this->renderAjax('p_findpay',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findpay',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findpay',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findpay',$part); //不调用layout
            }
        }
    }
    public function actionAq()
    {
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
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
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="10";
        $c1 = $req->get('c1','');
        $cK = $req->get('_k','');
        if($cK!=pub::enFormMD5('open',$c1))
            return $this->renderContent(langs::get('checkerror'));
        $sql="select count(*) from sys_answer where id='$c1' and status=1 ";
        $count=Yii::$app->db->createCommand($sql)->queryScalar();
        if($count==1){
            $data=array(
                'teachid' => Yii::$app->user->identity->id,
                'teachname' => Yii::$app->user->identity->UserName,
                'status'=>3
            );
            $tra1 = Yii::$app->db->beginTransaction();
            $ts = Yii::$app->db->createCommand()->update('sys_answer', $data, ['id' => $c1])->execute();
            $tra1->commit();
        }else{
            return $this->renderContent('<script>  $(function() { alert("已被其他教师抢答！");history.go(-1)}); </script>');
        }
        $sql="select a.*,b.FileId,b.FilePath,c.voicecoin,c.imagecoin,c.subject from sys_answer a left join sys_file b on a.cid=b.FileId 
              left join sys_subject c on a.subjectid=c.id where a.id='$c1'";
        $data=Yii::$app->db->createCommand($sql)->queryOne();
        $cid =pub::guid();//图片唯一id
        $part = array(
            "host"=>$host,
            "timestamp"=>$timestamp,
            "noncestr"=>$noncestr,
            "signature"=>$signature,
            'CID'=>$cid,
            'data'=> $data,
            'rop'=>"add",
            'rk'=>pub::enFormMD5('add')
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_aq', $part);
        }else {
            return $this->render('aq', $part);
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
                    'InUser'=>Yii::$app->user->identity->UserName
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
    public function actionTeachsave(){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        if (!$req->isPost){
            $r = '非法提交，无法使用！!';
            return $this->renderContent($r);
        }
        $r = "[0000]";
        $cId=$req->post("vId","");
        $pic64=$req->post("pic64","");
        $cAnswerId=$req->post("vAnswerId","");
        $cCID=$req->post("vCID","");
        $cP = $req->post('vP',"");
        $cCoin = $req->post('vCoin',"");
        if(!empty($pic64)){
            foreach ($pic64 as $v){
                $this->actionUploadqiniu($cCID,$v);
            }
        }
        $cTeachContent = $req->post('vTeachContent',"");
        $ck=$req->post('_k','');
        $cadd=pub::enFormMD5("add");
        $cedit=pub::enFormMD5("edit",$cId);
        $tra1 = Yii::$app->db->beginTransaction();
        try {
            if (!$req->isPost){
                $r = '非法提交，无法使用！!';
                throw new Exception($r);
            }
            if ($ck==$cadd) { //增加
                try {
                    $data = array(
                        'cid'=>$cCID,
                        'answerid'=>$cAnswerId,
                        'teachcontent'=>$cTeachContent,
                        'coin'=>$cCoin,
                        'teachname'=>Yii::$app->user->identity->UserName,
                        'teachid'=>Yii::$app->user->identity->id,
                        'addtime'=>date('Y-m-d H:i:s',time()),
                    );
                    $ts = Yii::$app->db->createCommand()->insert('sys_teachanswerd', $data)->execute();
                    if($ts){
                        Yii::$app->db->createCommand()->update('sys_answer', array("status"=>2), ['id' => $cAnswerId])->execute();
                        $teachid=Yii::$app->user->identity->id;
                        $date=date('Y-m',time());
                        $sql="select * from sys_teachpay where teachid='$teachid' and  date='$date' and status=1";
                        $pay=Yii::$app->db->createCommand($sql)->queryOne();
                        if(empty($pay)){
                            $data = array(
                                'coin'=>$cCoin,
                                'teachname'=>Yii::$app->user->identity->UserName,
                                'teachid'=>Yii::$app->user->identity->id,
                                'date'=>$date,
                                'indate'=>date('Y-m-d H:i:s',time()),
                            );
                            Yii::$app->db->createCommand()->insert('sys_teachpay', $data)->execute();
                        }else{
                            $data = array(
                                'coin'=>$pay['coin']+$cCoin,
                            );
                            Yii::$app->db->createCommand()->update('sys_teachpay', $data, ['id' => $pay['id']])->execute();
                        }
                    }
                    $tra1->commit();
                }catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "新增保存失败！";
                    throw new Exception($r);
                }
            } elseif ($ck==$cedit) { //修改保存
                try {
                    $data = array(
                        'teachcontent'=>$cTeachContent
                    );
                    $ts=Yii::$app->db->createCommand()->update('sys_teachanswerd', $data, ['id' => $cId])->execute();
                    $tra1->commit();
                } catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "新增保存失敗請重試再联络技术专员！";
                    throw new Exception($r);
                }
            } else { //验证失败，不能保存
                $r = langs::get('checkerror');
                throw new Exception($cedit);
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
    public function actionQuestiondetail()//答疑收支管理
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
    public function actionWaivehead(){    //删除 ajax提交自己加参数判断
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        $r = "[0000]";
        if (!$req->isPost){
            $r = '非法提交，无法使用！';
            return $this->renderContent($r);
        }
        $c1= $req->get('c1',"");
        $cK=$req->get('_k','');
        //验证提交信息合法性  验证唯一ID
        if($cK!=pub::enFormMD5('edit',$c1))
            return $this->renderContent(langs::get('checkerror'));
        //删除信息
        $tra1 = Yii::$app->db->beginTransaction();
        try{
            $data=array(
                'status'=>1,
                'teachid'=>"",
                'teachname'=>"",
            );
            Yii::$app->db->createCommand()->update('sys_answer', $data, ['id' => $c1])->execute();
            $tra1->commit();
        }catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = "放弃失败！";
        }
        return $this->renderContent($r);
    }
}
