<?php
namespace app\controllers\admin; //basic 二级目录控制器
use Yii;
use yii\db\Exception;
use app\core\base\BaseController;
use app\models\langs;
use app\models\pub;
use app\models\cupage;

class AnswermanageController extends BaseController
{
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
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
       // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $part = array(

        );
        if ( pub::is_mobile() ) {
            return $this->render('p_index', $part);
        }else {
            return $this->render('index', $part);
        }
    }
    public function actionSubindex()//答疑科目管理
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $part = array(

        );
        if ( pub::is_mobile() ) {
            return $this->render('p_subindex', $part);
        }else {
            return $this->render('subindex', $part);
        }
    }
    public function actionTeachindex()//答疑教师管理
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $part = array(

        );
        if ( pub::is_mobile() ) {
            return $this->render('p_teachindex', $part);
        }else {
            return $this->render('teachindex', $part);
        }
    }
    public function actionTeachfind($p='1'){    //查询动作
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        $page = $req->get('p',$p);
        $perNumber=10; //每页显示的记录数
        $where=" where 1=1 and a.RoleID =4 ";
        $sql = "SELECT count(1) FROM sys_user a $where ";
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
            'ajax_func_name'=>'teachfind',
            'parameter'=>"",  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select a.*,b.count,b.rankall from sys_user a  LEFT JOIN (SELECT teachid,count(*) as count ,sum(rank) as rankall 
                from sys_teachanswerd GROUP BY teachid ) b ON a.id=b.teachid $where order by a.id DESC limit $startCount,$perNumber ";
        //  print_r ($sql);
        $d_data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($d_data as $k=>$v){
            $subjectid=explode(",",$v['AnswerSubject']);
            $subject="";
            foreach ($subjectid as $t){
                $sql = "select subject from sys_subject where id= $t";
                $subjectname = Yii::$app->db->createCommand($sql)->queryScalar();
                $subject .=$subjectname.',';
            }
            $d_data[$k]['Subject']=rtrim($subject,",");
        }

        //返回值处理或调用模板
        $part = array(
            'd_data'=>$d_data,
            'page'=>$pages,
            'rK'=>pub::enFormMD5('add','')
        );
        if ( pub::is_mobile() ) {
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('teachfindphone',$part); //不调用layout
            }else{   //普通提交
                return $this->render('teachfindphone',$part); //不调用layout
            }
        }else {
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('teachfind',$part); //不调用layout
            }else{   //普通提交
                return $this->render('teachfind',$part); //不调用layout
            }
        }
    }
    public function actionTeachcreate(){  //新增加的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";//手机指定框架
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $view = Yii::$app->view->params['data']="9";
        $cCID =pub::guid();//图片唯一id
        $sql="select * from sys_subject order by id desc";
        $s_data = Yii::$app->db->createCommand($sql)->queryAll();
        //接收GET，POST的数据及验证
        $part = array(
            's_data'=>$s_data,
            'CID'=>$cCID,
            'r_data'=>"",
            'rp'=>1,
            'rop'=>"add",
            'rk'=>pub::enFormMD5('add')
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('p_teachcreate', $part);
        }else {
            return $this->render('teachcreate', $part);
        }
    }

    public function actionTeachsave(){    //新加保存
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        if (!$req->isPost){
            $r = '非法提交，无法使用！!';
            return $this->renderContent($r);
        }
        $r = "[0000]";
        $cId=$req->post("vId","");
        $cCID=$req->post("vCID","");
        $cP = $req->post('vP',"");

        $cPhone = pub::chkPost($req->post('vPhone',""),"","【手机号码】不能为空");
        $cUserName = pub::chkPost($req->post('vUserName',""),"","【姓名】不能为空");
        $cPassWord1= pub::chkPost($req->post('vPassWord1',""),"","【密码】不能为空");
        $cPassWord2= pub::chkPost($req->post('vPassWord2',""),"","【密码】不能为空");
        $cBank= pub::chkPost($req->post('vBank',""),"","【开户行】不能为空");
        $cAliname= pub::chkPost($req->post('vAliname',""),"","【用户名】不能为空");
        $cBankNum= pub::chkPost($req->post('vBankNum',""),"","【卡号】不能为空");
        $cAlinum= pub::chkPost($req->post('vAlinum',""),"","【支付宝账号】不能为空");
        $cAnswerSubject= $req->post('vAnswerSubject',"");
        $AnswerSubject="";
        foreach ($cAnswerSubject as $v){
            $AnswerSubject .=$v.",";
        }

        if ($cPassWord1<>$cPassWord2){
            print_r("两次密码输入不一致！");
            Yii::$app->end();
        }
        $cContent = $req->post('vContent',"");
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
                //判断用户是否重复，用户账号唯一
                $sql = "select count(1) FROM sys_user WHERE UserName ='" . $cUserName . "'";
                $count = Yii::$app->db->createCommand($sql)->queryScalar();
                if ($count > 0) {
                    $r = '添加的用户已经重复，请修改后再保存！';
                } else {
                    try {
                        $data = array(
                            'UserName' => $cUserName,
                            'UserFull'=>$cUserName,
                            'UserPwd' => md5($cPassWord1),
                            'RoleID' => 4,
                            'UserType' => 2,
                            'Phone' => $cPhone,
                            'UserInfo' => $cContent,
                            'UserStatus' => 1,
                            'CID'=>$cCID,
                            'Bank'=>$cBank,
                            'Aliname'=>$cAliname,
                            'BankNum'=>$cBankNum,
                            'Alinum'=>$cAlinum,
                            'AnswerSubject'=>rtrim($AnswerSubject,","),
                            'InTime'=>date('Y-m-d h:i:s',time()),
                            'InUserName'=>Yii::$app->user->identity->UserName,
                        );
                        $ts = Yii::$app->db->createCommand()->insert('sys_user', $data)->execute();
                        $tra1->commit();
                    } catch (Exception $e) {
                        pub::wrlog($e->getMessage());
                        $r = "新增保存失败！";
                        throw new Exception($r);
                    }
                }
            } elseif ($ck==$cedit) { //修改保存
                try {
                    $data = array(
                        'UserName' => $cUserName,
                        'UserFull'=>$cUserName,
                        'UserPwd' => md5($cPassWord1),
                        'RoleID' => 4,
                        'UserType' => 2,
                        'Phone' => $cPhone,
                        'UserInfo' => $cContent,
                        'UserStatus' => 1,
                        'CID'=>$cCID,
                        'Bank'=>$cBank,
                        'Aliname'=>$cAliname,
                        'BankNum'=>$cBankNum,
                        'Alinum'=>$cAlinum,
                        'AnswerSubject'=>rtrim($AnswerSubject,","),
                        'InTime' => date('Y-m-d h:i:s', time()),
                        'InUserName' => Yii::$app->user->identity->UserName,
                    );
                    $ts = Yii::$app->db->createCommand()->update('sys_user', $data, ['id' => $cId])->execute();
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
    public function actionTeachedit(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";//手机指定框架
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $view = Yii::$app->view->params['data']="9"; //给框架加参数
        $sql="select * from sys_subject order by id desc";
        $s_data = Yii::$app->db->createCommand($sql)->queryAll();
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
        if($cK!=pub::enFormMD5('edit',$cId))
            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql = "select a.*,b.FileId,b.FilePath from sys_user a LEFT JOIN sys_file b on  a.CID=b.FileId where a.id='$cId'";
        $r_data=Yii::$app->db->createCommand($sql)->queryOne();
        $part = array(
            's_data'=>$s_data,
            'CID'=>$r_data['CID'],
            'r_data'=>$r_data,
            'rp'=>$req->get('p',1), //当前页码
            'rop'=>"edit",
            'rk'=>pub::enFormMD5('edit',$cId)
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('p_teachcreate', $part);
        }else {
            return $this->render('teachcreate', $part);
        }
    }//end of EitdHead
    public function actionToanswerindex()//待回答主页
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $sql="select id,subject from sys_subject order by id ";
        $s_data=Yii::$app->db->createCommand($sql)->queryAll();
        $part = array(
            's_data'=>$s_data
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_toanswerindex', $part);
        }else {
            return $this->render('toanswerindex', $part);
        }
    }
    public function actionFindtoanswer($p='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $subjectid = $req->post('subjectid','');
        $where = " where 1=1 and a.status =1";
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
            'ajax_func_name'=>'findHead',
            'parameter'=>'',  #(必须)
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
                return $this->renderAjax('p_findtoanswer',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findtoanswer',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findtoanswer',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findtoanswer',$part); //不调用layout
            }
        }
    }
    public function actionToansweredit(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";//手机指定框架
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $view = Yii::$app->view->params['data']="9"; //给框架加参数
        $sql="select * from sys_subject order by id desc";
        $s_data = Yii::$app->db->createCommand($sql)->queryAll();
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
        if($cK!=pub::enFormMD5('edit',$cId))
            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql = "select a.*,b.subject from sys_answer a left join sys_subject b on a.subjectid=b.id where a.id='$cId'";
        $r_data=Yii::$app->db->createCommand($sql)->queryOne();
        $part = array(
            's_data'=>$s_data,
            'r_data'=>$r_data,
            'rp'=>$req->get('p',1), //当前页码
            'rop'=>"edit",
            'rk'=>pub::enFormMD5('edit',$cId)
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('p_toansweredit', $part);
        }else {
            return $this->render('toansweredit', $part);
        }
    }//end of EitdHead
    public function actionAnswerdedit(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";//手机指定框架
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $view = Yii::$app->view->params['data']="9"; //给框架加参数
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
        if($cK!=pub::enFormMD5('edit',$cId))
            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql="select a.*,c.FilePath as headimg from sys_teachanswerd a left join  sys_user b on a.teachid=b.id left join sys_file c on b.CID=c.FileId where a.id ='$cId' limit 1";
        $r_data=Yii::$app->db->createCommand($sql)->queryOne();
        $sql="select type,FilePath from sys_file where FileId='".$r_data['cid']."'";
        $teachfile=Yii::$app->db->createCommand($sql)->queryAll();
        $r_data['teachfile']=$teachfile;
        $sql="select a.*,b.FileId,b.FilePath,c.voicecoin,c.imagecoin,c.subject from sys_answer a left join sys_file b on a.cid=b.FileId 
              left join sys_subject c on a.subjectid=c.id where a.id='".$r_data['answerid']."'";
        $s_data=Yii::$app->db->createCommand($sql)->queryOne();
        $part = array(
            's_data'=>$s_data,
            'r_data'=>$r_data,
            'rp'=>$req->get('p',1), //当前页码
            'rop'=>"edit",
            'rk'=>pub::enFormMD5('edit',$cId)
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('p_answerdedit', $part);
        }else {
            return $this->render('answerdedit', $part);
        }
    }//end of EitdHead
    public function actionAnsweredindex()//已回答主页
    {
        parent::actionIndex();//调用父方法
        $sql="select id,subject from sys_subject order by id ";
        $s_data=Yii::$app->db->createCommand($sql)->queryAll();
        $sql="select id,UserName from sys_user where RoleID=4 order by id ";
        $t_data=Yii::$app->db->createCommand($sql)->queryAll();
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $part = array(
            's_data'=>$s_data,
            't_data'=>$t_data
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_answeredindex', $part);
        }else {
            return $this->render('answeredindex', $part);
        }
    }
    public function actionFindanswerd($p='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $subjectid = $req->post('subjectid','');
        $teachid = $req->post('teachid','');
        $where = " where 1=1 and a.status =2";
        if(!empty($subjectid)){
            $subjectid=trim($subjectid); /*去除变量所以空格*/
            $where .=" and a.subjectid =$subjectid";
        }
        if(!empty($teachid)){
            $teachid=trim($teachid); /*去除变量所以空格*/
            $where .=" and a.teachid =$teachid";
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
            'ajax_func_name'=>'findHead',
            'parameter'=>'',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select a.*,b.subject,b.voicecoin,b.imagecoin,c.type as filetype,c.FilePath,d.addtime,d.id as teachanswerid  from sys_answer a left join sys_subject b on a.subjectid=b.id 
                    left join sys_file c on a.cid = c.FileId left join sys_teachanswerd d on a.id=d.answerid
                    $where order by d.addtime DESC limit $startCount,$perNumber ";
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
                return $this->renderAjax('p_findanswerd',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findanswerd',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findanswerd',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findanswerd',$part); //不调用layout
            }
        }
    }
    public function actionFindfee($p='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $teachid = $req->post('teachid','');
        $year = $req->post('year','');
        $month = $req->post('month','');
        $where = " where 1=1 ";
        if(!empty($teachid)){
            $teachid=trim($teachid); /*去除变量所以空格*/
            $where .=" and teachid =$teachid";
        }
        if(!empty($year)){
            $year=trim($year); /*去除变量所以空格*/
            $where .=" and left(date,4) =$year";
        }
        if(!empty($month)){
            $month=trim($month); /*去除变量所以空格*/
            $where .=" and right(date,2) =$month";
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
            'ajax_func_name'=>'findHead',
            'parameter'=>'',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select * from sys_teachpay $where order by indate DESC limit $startCount,$perNumber ";
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
                return $this->renderAjax('p_findfee',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findfee',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findfee',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findfee',$part); //不调用layout
            }
        }
    }
    public function actionFeeindex()//答疑收支管理
    {
        parent::actionIndex();//调用父方法
        $sql="select id,UserName from sys_user where RoleID=4 order by id ";
        $t_data=Yii::$app->db->createCommand($sql)->queryAll();
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $part = array(
            't_data'=>$t_data
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_feeindex', $part);
        }else {
            return $this->render('feeindex', $part);
        }
    }
    public function actionFindfeedetail($p='1'){
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $page = $req->get('p',$p);
        $c1 = $req->get('c1','');
        $c2 = $req->get('c2','');
        $where = " where 1=1 and a.teachid=".$c1." AND left(a.addtime ,7)='$c2'";
        $perNumber=10; //每页显示的记录数
        $sql = "SELECT count(1) FROM sys_teachanswerd a  $where ";
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
            'ajax_func_name'=>'findHead',
            'parameter'=>'',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "SELECT a.*,b.username,c.subject FROM sys_teachanswerd a LEFT JOIN sys_answer b ON a.answerid=b.id  
              left join sys_subject c on b.subjectid=c.id
              $where order by a.addtime DESC limit $startCount,$perNumber ";
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
                return $this->renderAjax('p_findfeedetail',$part); //不调用layout
            }else{   //普通提交
                return $this->render('p_findfeedetail',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findfeedetail',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findfeedetail',$part); //不调用layout
            }
        }
    }
    public function actionFeeindexdetail()//答疑收支管理
    {
        parent::actionIndex();//调用父方法
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        $c1 = $req->get('c1','');
        $c2 = $req->get('c2','');
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        // $this->layout = "mainindex"; //指定框架
        $view = Yii::$app->view->params['data']="9";
        $part = array(
            'c1'=>$c1,
            'c2'=>$c2
        );
        if ( pub::is_mobile() ) {
            return $this->render('p_feeindexdetail', $part);
        }else {
            return $this->render('feeindexdetail', $part);
        }
    }
    public function actionSubfind($p='1'){    //查询动作
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        $page = $req->get('p',$p);
        $perNumber=10; //每页显示的记录数
        $where=" where 1=1  ";
        $sql = "SELECT count(1) FROM sys_subject  $where ";
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
            'ajax_func_name'=>'subfind',
            'parameter'=>"",  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select * from sys_subject $where order by id DESC limit $startCount,$perNumber ";
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
                return $this->renderAjax('subfindphone',$part); //不调用layout
            }else{   //普通提交
                return $this->render('subfindphone',$part); //不调用layout
            }
        }else {
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('subfind',$part); //不调用layout
            }else{   //普通提交
                return $this->render('subfind',$part); //不调用layout
            }
        }
    }
    public function actionSubcreate(){  //新增加的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";//手机指定框架
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $view = Yii::$app->view->params['data']="9";
        $cCID =pub::guid();
        //接收GET，POST的数据及验证
        $part = array(
            'CID'=>$cCID,
            'r_data'=>"",
            'rp'=>1,
            'rop'=>"add",
            'rk'=>pub::enFormMD5('add')
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('p_subcreate', $part);
        }else {
            return $this->render('subcreate', $part);
        }
    }
    public function actionSubedit(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone";//手机指定框架
        }else {
            $this->layout = "mainindex"; //指定框架
        }
        $view = Yii::$app->view->params['data']="9"; //给框架加参数
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
        if($cK!=pub::enFormMD5('edit',$cId))
            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql = "select a.*,b.FileId,b.FilePath from sys_subject a left join sys_file b on a.CID=b.FileId where a.id='$cId'";
        $r_data=Yii::$app->db->createCommand($sql)->queryOne();
        $part = array(
            'CID'=>$r_data['CID'],
            'r_data'=>$r_data,
            'rp'=>$req->get('p',1), //当前页码
            'rop'=>"edit",
            'rk'=>pub::enFormMD5('edit',$cId)
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('subcreatephone', $part);
        }else {
            return $this->render('subcreate', $part);
        }
    }//end of EitdHead
    public function actionSubsave(){    //新加保存
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        if (!$req->isPost){
            $r = '非法提交，无法使用！!';
            return $this->renderContent($r);
        }
        $r = "[0000]";
        $cId=$req->post("vId","");
        $cCID=$req->post("vCID","");
        $cP = $req->post('vP',"");
        $cSubject = pub::chkPost($req->post('vSubject',""),"","【题号】不能为空");
        $cVoice = $req->post('vVoice',"");
        $cVoicecoin = $req->post('vVoicecoin',"");
        $cImage = $req->post('vImage',"");
        $cImagecoin = $req->post('vImagecoin',"");
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
                        'CID'=>$cCID,
                        'subject'=>$cSubject,
                        'voice'=>$cVoice,
                        'voicecoin' => $cVoicecoin,
                        'image'    =>$cImage,
                        'imagecoin'    =>$cImagecoin,
                        'inuser'=>Yii::$app->user->identity->UserName,
                        'addtime'=>date('Y-m-d H:i:s',time()),
                    );
                    $ts = Yii::$app->db->createCommand()->insert('sys_subject', $data)->execute();
                    $tra1->commit();
                }catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "新增保存失败！";
                    throw new Exception($r);
                }
            } elseif ($ck==$cedit) { //修改保存
                try {
                    $data = array(
                        'CID'=>$cCID,
                        'subject'=>$cSubject,
                        'voice'=>$cVoice,
                        'voicecoin' => $cVoicecoin,
                        'image'    =>$cImage,
                        'imagecoin'    =>$cImagecoin,
                        'inuser'=>Yii::$app->user->identity->UserName,
                        'addtime'=>date('Y-m-d H:i:s',time()),
                    );
                    $ts=Yii::$app->db->createCommand()->update('sys_subject', $data, ['id' => $cId])->execute();
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
    public function actionSubdel(){    //删除 ajax提交自己加参数判断
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
        if($cK!=pub::enFormMD5('del',$c1))
            return $this->renderContent(langs::get('checkerror'));
        //删除信息
        $tra1 = Yii::$app->db->beginTransaction();
        try{
            Yii::$app->db->createCommand()->delete('sys_subject',['id'=>$c1])->execute();
            $tra1->commit();
        }catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = "删除失败！";
        }
        return $this->renderContent($r);
    }
    public function actionTeachdel(){    //删除 ajax提交自己加参数判断
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
        if($cK!=pub::enFormMD5('del',$c1))
            return $this->renderContent(langs::get('checkerror'));
        //删除信息
        $tra1 = Yii::$app->db->beginTransaction();
        try{
            Yii::$app->db->createCommand()->delete('sys_user',['id'=>$c1])->execute();
            $tra1->commit();
        }catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = "删除失败！";
        }
        return $this->renderContent($r);
    }
    public function actionToanswerdel(){    //删除 ajax提交自己加参数判断
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
        if($cK!=pub::enFormMD5('del',$c1))
            return $this->renderContent(langs::get('checkerror'));
        //删除信息
        $tra1 = Yii::$app->db->beginTransaction();
        try{
            Yii::$app->db->createCommand()->delete('sys_answer',['id'=>$c1])->execute();
            $tra1->commit();
        }catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = "删除失败！";
        }
        return $this->renderContent($r);
    }
    public function actionFeeconfirm(){    //删除 ajax提交自己加参数判断
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
            Yii::$app->db->createCommand()->update('sys_teachpay', array("status"=>2), ['id' => $c1])->execute();
            $tra1->commit();
        }catch (Exception $e) {
            $tra1->rollBack();
            pub::wrlog($e->getMessage());
            $r = "删除失败！";
        }
        return $this->renderContent($r);
    }
}
