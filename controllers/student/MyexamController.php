<?php
namespace app\controllers\student; //basic 二级目录控制器
use Yii;
use yii\db\Exception;
use app\core\base\BaseController;
use app\models\langs;
use app\models\pub;
use app\models\cupage;

class MyexamController extends BaseController
{
//    public function beforeAction($action)
//    {
//        return $this->renderContent(langs::get('noright'));
//        return true;
//    }
    public function actions()
    { //默认执行动作
        parent::actions();//调用父方法
    }
    public function actionIndex()
    {
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $url="https://api.kaoben.top/courses/all-nodes";
            $ch = curl_init(); //设置选项，包括URL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $output = curl_exec($ch); //释放curl句柄
            curl_close($ch);
            $data=json_decode($output,true);
            //   file_put_contents('E:/log/l' . time() . '.txt', print_r($data, true), FILE_APPEND);
            $this->layout = "mainphone";//手机指定框架
            $view = Yii::$app->view->params['data']="8"; //给框架加参数
            $part = array(
                'data'=>$data,
                // 's_data'=>$s_data,
                'detail' => array(),
                'rK' => pub::enFormMD5('add', '')
            );
        }else {
            $this->layout = "mainindex"; //指定框架
            $view = Yii::$app->view->params['data']="8"; //给框架加参数
            $part = array(
                // 'data'=>$data,
                // 's_data'=>$s_data,
                'detail' => array(),
                'rK' => pub::enFormMD5('add', '')
            );
        }
        if ( pub::is_mobile() ) {
            return $this->render('p_index', $part);
        }else {
            return $this->render('index', $part);
        }
    }
    public function actionFindhead($p='1'){    //查询动作
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        $page = $req->get('p',$p);
        $cSubId = $req->post('vSubId',"");
        $cCourseId = $req->post('vCourseId',"");
        $cSectionId = $req->post('vSectionId',"");
        $userid=yii::$app->session['studentuser']['userid'];
        $where = " where 1=1 ";
        if(!empty($cSubId)){
            $cSubId=trim($cSubId); /*去除变量所以空格*/
            $where .=" and b.examsubid = '$cSubId'";
        }
        if(!empty($cCourseId)){
            $cCourseId=trim($cCourseId); /*去除变量所以空格*/
            $where .=" and b.examcourseid = '$cCourseId'";
        }
        if(!empty($cSectionId)){
            $cSectionId=trim($cSectionId); /*去除变量所以空格*/
            $where .=" and b.examcoursesectionid = '$cSectionId'";
        }
        $perNumber=10; //每页显示的记录数
        $sql = "SELECT count(1) FROM sys_examhistory a LEFT JOIN sys_exam b  on a.ehexamid=b.examid  $where and a.userid='$userid' ";
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
            'parameter'=>"",  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows'=>$perNumber, #(可选) 默认为15
        );
        $pages= new Cupage($part);
        $sql = "select * from sys_examhistory a LEFT JOIN sys_exam b on a.ehexamid=b.examid $where and a.userid='$userid' order by ehendtime DESC limit $startCount,$perNumber ";
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
                return $this->renderAjax('findphonehead',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findphonehead',$part); //不调用layout
            }
        }else{
            if ($req->isAjax){ //ajax提交
                return $this->renderAjax('findhead',$part); //不调用layout
            }else{   //普通提交
                return $this->render('findhead',$part); //不调用layout
            }
        }

    }
    public function actionCreatehead(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone"; //指定框架
            $view = Yii::$app->view->params['data']="8"; //给框架加参数
        }else{
            $this->layout = "mainindex"; //指定框架
            $view = Yii::$app->view->params['data']="exam"; //给框架加参数
        }
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
//        if($cK!=pub::enFormMD5('add') || $cK!=pub::enFormMD5('edit'))
//            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql="select * from sys_examhistory where ehid='$cId'";
        $eh_data = Yii::$app->db->createCommand($sql)->queryOne();


        $examid=$eh_data['ehexamid'];
        $answer=unserialize($eh_data['ehanswer']);
        $r_data=array();
        foreach($answer as $key=>$val){
            $r_data[]=array("u_questionid"=>$key,"u_answer"=>$val);
        }

        $sql="select * from sys_type where examid='$examid'  order by typeid";
        $t_data= Yii::$app->db->createCommand($sql)->queryAll();//取出题型

        $sql="select * from sys_exam where examid='$examid'";
        $exam_data = Yii::$app->db->createCommand($sql)->queryOne();

        $question_data= array();
        foreach ($t_data as $key=>$val) {
            $sql="Select (@i:=@i+1) as RowNum, A.*,C.type from sys_question A left join sys_type C on A.questiontype=C.typeid ,(Select @i:=0 ) B  WHERE A.examid='$examid'  AND  questionparent='0'
                 AND A.questiontype='".$val['typeid']."' ";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            foreach ($data as $k=>$v ){
                if($v['questioncap']==1){
                    $sql="Select (@i:=@i+1) as RowNum, A.*,C.type from sys_question A left join sys_type C on A.questiontype=C.typeid ,(Select @i:=0 ) B  WHERE 
                          A.questionparent='".$v['questionid']."'";
                    $cap_data = Yii::$app->db->createCommand($sql)->queryAll();
                    foreach ($cap_data as $ckey =>$cval){
                        $cap_data[$ckey]['u_answer']="";
                        foreach ($r_data as $rkey => $rval){
                            if($cval['questionid']==$rval['u_questionid']){
                                $cap_data[$ckey]['u_answer']=$rval['u_answer'];
                                break;
                            }
                        }
                    }
                    $data[$k]= array_merge(array('capquestion'=>$cap_data),$v);
                }else{
                    $data[$k]= array_merge(array('capquestion'=>""),$v);
                }
            }
            foreach ($data as $key1 => $val1){
                $data[$key1]['u_answer']="";
                foreach ($r_data as $key2 => $val2){
                    if($val1['questionid']==$val2['u_questionid']){
                        $data[$key1]['u_answer']=$val2['u_answer'];
                        break;
                    }
                }
            }
            $question_data[$key] = array_merge(array('question' => $data), $val);
        }//取出试题

        //
        $part = array(
            't_data'=>$t_data,
            'starttime'=>time(),
            'question_data'=>$question_data,
            'exam_data'=>$exam_data,
            'eh_data'=>$eh_data,
            'rp'=>$req->get('p',1), //当前页码
            'rk'=>pub::enFormMD5('add'),
            'rop'=>"add"
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('createphonehead', $part);
        }else{
            return $this->render('createhead', $part);
        }

    }//end of EitdHead
    public function actionSavehead(){    //新加保存
        $req = Yii::$app->request;
        $this->layout = 0; //不调用layout模板
        //接收GET，POST的数据及验证
        if (!$req->isPost){
            $r = '非法提交，无法使用！!';
            return $this->renderContent($r);
        }
        $r = "[0000]";
        $cId=$req->post("vEhId","");
        $cScore=$req->post("vScore","");
        $cErrors=$req->post("vErrors","");
        $cComment=$req->post("vComment","");
        $cUserId=$req->post("vUserId","");
        $cUserName=$req->post("vUserName","");
       // $cErrors=$req->post("vErrors","");
        if(!empty($cScore)){
            $cScoreAll=0;
            foreach($cScore as $v){
                $cScoreAll+=$v;
            }
        }
        $cScore= serialize($cScore);
        $cErrors= serialize($cErrors);
        $cComment= serialize($cComment);
        $ck=$req->post('_k','');

        $cadd=pub::enFormMD5("add");
        $cedit=pub::enFormMD5("edit",$cId);
      //  file_put_contents('E:/log/l' . time() . '.txt', print_r($cedit, true), FILE_APPEND);
        $tra1 = Yii::$app->db->beginTransaction();
        try {
            if (!$req->isPost){
                $r = '非法提交，无法使用！!';
                throw new Exception($r);
            }
            if ($ck==$cadd) { //增加
                try {
                    $data = array(
                        'ehscore'=>$cScoreAll,
                       'ehscorelist'=>$cScore,
                        'errorlist'=>$cErrors,
                        'ehcomment'=>$cComment,
                        'ehcheckuser'=>$cUserId,
                        'chcheckusername'=>$cUserName,
                        'ehgardestatus'=>2
                    );
                    $ts=Yii::$app->db->createCommand()->update('sys_examhistory', $data, ['ehid' => $cId])->execute();
                    $tra1->commit();
                }catch (Exception $e) {
                    pub::wrlog($e->getMessage());
                    $r = "新增保存失败！";
                    throw new Exception($r);
                }
            } elseif ($ck==$cedit) { //修改保存
                try {
                    $data = array(
                        'ehscore'=>$cScoreAll,
                        'ehscorelist'=>$cScore,
                        'errorlist'=>$cErrors,
                        'ehcomment'=>$cComment,
                        'ehcheckuser'=>$cUserId,
                        'chcheckusername'=>$cUserName,
                        'ehgardestatus'=>2
                    );
                    $ts=Yii::$app->db->createCommand()->update('sys_examhistory', $data, ['ehid' => $cId])->execute();
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
    public function actionLoadhead(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone"; //指定框架
            $view = Yii::$app->view->params['data']="8"; //给框架加参数
        }else{
            $this->layout = "mainindex"; //指定框架
            $view = Yii::$app->view->params['data']="exam"; //给框架加参数
        }
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
        if($cK!=pub::enFormMD52('open',$cId))
            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql="select * from sys_examhistory where ehid='$cId'";
        $eh_data = Yii::$app->db->createCommand($sql)->queryOne();

        $examid=$eh_data['ehexamid'];
        $answer=unserialize($eh_data['ehanswer']);
        $ehscorelist=unserialize($eh_data['ehscorelist']);
        $ehcomment=unserialize($eh_data['ehcomment']);
        $r_data=array();
        if(!empty($answer)){
            foreach($answer as $key=>$val){
                $r_data[]=array("u_questionid"=>$key,"u_answer"=>$val);
            }
        }else{
            $r_data[]=array("u_questionid"=>"","u_answer"=>"");
        }
        // file_put_contents('e:/log/l' . time() . '.txt', print_r($r_data, true), FILE_APPEND);
        $r_ehscorelist=array();
        if(!empty($ehscorelist)){
            foreach($ehscorelist as $key=>$val){
                $r_ehscorelist[]=array("u_questionid"=>$key,"t_score"=>$val);
            }
        }else{
            $r_ehscorelist[]=array("u_questionid"=>"","t_score"=>"");
        }
        $r_ehcomment = array();
        if(!empty($ehcomment)) {
            foreach ($ehcomment as $key => $val) {
                $r_ehcomment[] = array("u_questionid" => $key, "t_content" => $val);
            }
        }else{
            $r_ehcomment[] = array("u_questionid" => "", "t_content" => "");
        }

        $sql="select * from sys_type where examid='$examid'  order by typeid";
        $t_data= Yii::$app->db->createCommand($sql)->queryAll();//取出题型

        $sql="select * from sys_exam where examid='$examid'";
        $exam_data = Yii::$app->db->createCommand($sql)->queryOne();

        $question_data= array();
        foreach ($t_data as $key=>$val) {
            $sql="Select (@i:=@i+1) as RowNum, A.*,C.type from sys_question A left join sys_type C on A.questiontype=C.typeid ,(Select @i:=0 ) B  WHERE A.examid='$examid'  AND  questionparent='0'
                 AND A.questiontype='".$val['typeid']."' ";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            foreach ($data as $k=>$v ){
                if($v['questioncap']==1){
                    $sql="Select (@i:=@i+1) as RowNum, A.*,C.type from sys_question A left join sys_type C on A.questiontype=C.typeid ,(Select @i:=0 ) B  WHERE 
                          A.questionparent='".$v['questionid']."'";
                    $cap_data = Yii::$app->db->createCommand($sql)->queryAll();
                    foreach ($cap_data as $ckey =>$cval){
                        $cap_data[$ckey]['u_answer']="";
                        foreach ($r_data as $rkey => $rval){
                            if($cval['questionid']==$rval['u_questionid']){
                                $cap_data[$ckey]['u_answer']=$rval['u_answer'];
                                break;
                            }
                        }
                    }
                    if($val['type']==3 || $val['type']==4){
                        foreach ($cap_data as $key1 => $val1){
                            $cap_data[$key1]['t_score']="";
                            foreach ($r_ehscorelist as $key2 => $val2){
                                if($val1['questionid']==$val2['u_questionid']){
                                    $cap_data[$key1]['t_score']=$val2['t_score'];
                                    break;
                                }
                            }
                        }
                        foreach ($cap_data as $key1 => $val1){
                            $cap_data[$key1]['t_content']="";
                            foreach ($r_ehcomment as $key2 => $val2){
                                if($val1['questionid']==$val2['u_questionid']){
                                    $cap_data[$key1]['t_content']=$val2['t_content'];
                                    break;
                                }
                            }
                        }
                    }
                    $data[$k]= array_merge(array('capquestion'=>$cap_data),$v);
                }else{
                    $data[$k]= array_merge(array('capquestion'=>""),$v);
                }
            }
                foreach ($data as $key1 => $val1){
                    $data[$key1]['u_answer']="";
                    foreach ($r_data as $key2 => $val2){
                        if($val1['questionid']==$val2['u_questionid']){
                            $data[$key1]['u_answer']=$val2['u_answer'];
                            break;
                        }
                    }
                }
            if($val['type']==3 || $val['type']==4){
                foreach ($data as $key1 => $val1){
                    $data[$key1]['t_score']="";
                    foreach ($r_ehscorelist as $key2 => $val2){
                        if($val1['questionid']==$val2['u_questionid']){
                            $data[$key1]['t_score']=$val2['t_score'];
                            break;
                        }
                    }
                }
                foreach ($data as $key1 => $val1){
                    $data[$key1]['t_content']="";
                    foreach ($r_ehcomment as $key2 => $val2){
                        if($val1['questionid']==$val2['u_questionid']){
                            $data[$key1]['t_content']=$val2['t_content'];
                            break;
                        }
                    }
                }
            }
            $question_data[$key] = array_merge(array('question' => $data), $val);
        }//取出试题
      //  file_put_contents('E:/log/l' . time() . '.txt', print_r($question_data, true), FILE_APPEND);
        $part = array(
            't_data'=>$t_data,
            'starttime'=>time(),
            'question_data'=>$question_data,
            'exam_data'=>$exam_data,
            'eh_data'=>$eh_data,
            'rp'=>$req->get('p',1), //当前页码
            'rk'=>$cK,
            'rop'=>"add"
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('loadphonehead', $part);
        }else{
            return $this->render('loadhead', $part);
        }

    }//end of EitdHead
    public function actionErrorhead(){  //修改的view
        $req = Yii::$app->request;
        parent::actionIndex();//调用父方法
        if ( pub::is_mobile() ) {
            $this->layout = "mainphone"; //指定框架
            $view = Yii::$app->view->params['data']="8"; //给框架加参数
        }else{
            $this->layout = "mainindex"; //指定框架
            $view = Yii::$app->view->params['data']="exam"; //给框架加参数
        }
        //接收GET，POST的数据及验证
        $cId = $req->get('c1','');
        $cK=$req->get('_k','');
        if($cK!=pub::enFormMD52('open',$cId))
            return $this->renderContent(langs::get('checkerror'));
        //取出信息
        $sql="select * from sys_examhistory where ehid='$cId'";
        $eh_data = Yii::$app->db->createCommand($sql)->queryOne();

        $r_error=array();
        $eherrorlist=unserialize($eh_data['errorlist']);
        foreach($eherrorlist as $key=>$val){
            $r_error[]=array("u_questionid"=>$key);
        }

        $examid=$eh_data['ehexamid'];
        $answer=unserialize($eh_data['ehanswer']);
        $ehscorelist=unserialize($eh_data['ehscorelist']);
        $ehcomment=unserialize($eh_data['ehcomment']);
        $r_data=array();
        if(!empty($answer)){
            foreach($answer as $key=>$val){
                $r_data[]=array("u_questionid"=>$key,"u_answer"=>$val);
            }
        }else{
            $r_data[]=array("u_questionid"=>"","u_answer"=>"");
        }
        // file_put_contents('e:/log/l' . time() . '.txt', print_r($r_data, true), FILE_APPEND);
        $r_ehscorelist=array();
        if(!empty($ehscorelist)){
            foreach($ehscorelist as $key=>$val){
                $r_ehscorelist[]=array("u_questionid"=>$key,"t_score"=>$val);
            }
        }else{
            $r_ehscorelist[]=array("u_questionid"=>"","t_score"=>"");
        }
        $r_ehcomment = array();
        if(!empty($ehcomment)) {
            foreach ($ehcomment as $key => $val) {
                $r_ehcomment[] = array("u_questionid" => $key, "t_content" => $val);
            }
        }else{
            $r_ehcomment[] = array("u_questionid" => "", "t_content" => "");
        }


        $sql="select * from sys_type where examid='$examid'  order by typeid";
        $t_data= Yii::$app->db->createCommand($sql)->queryAll();//取出题型

        $sql="select * from sys_exam where examid='$examid'";
        $exam_data = Yii::$app->db->createCommand($sql)->queryOne();


        $question_data= array();

        foreach ($t_data as $key=>$val) {
            $sql="Select (@i:=@i+1) as RowNum, A.*,C.type from sys_question A left join sys_type C on A.questiontype=C.typeid ,(Select @i:=0 ) B  WHERE A.examid='$examid'  AND  questionparent='0'
                 AND A.questiontype='".$val['typeid']."' ";
            $q_data = Yii::$app->db->createCommand($sql)->queryAll();
            $data="";
            foreach ($q_data as $k=>$v ){
                if($v['questioncap']==1){
                    $sql="Select (@i:=@i+1) as RowNum, A.*,C.type from sys_question A left join sys_type C on A.questiontype=C.typeid ,(Select @i:=0 ) B  WHERE 
                          A.questionparent='".$v['questionid']."'";
                    $c_data = Yii::$app->db->createCommand($sql)->queryAll();
                    $cap_data="";
                    foreach ($c_data as $a){
                        foreach ($r_error as $b){
                            if($a['questionid']==$b['u_questionid']){
                                $cap_data[]=$a;
                            }
                        }
                    }
                    if(!empty($cap_data)) {
                        foreach ($cap_data as $ckey => $cval) {
                            $cap_data[$ckey]['u_answer'] = "";
                            foreach ($r_data as $rkey => $rval) {
                                if ($cval['questionid'] == $rval['u_questionid']) {
                                    $cap_data[$ckey]['u_answer'] = $rval['u_answer'];
                                    break;
                                }
                            }
                        }
                    }
                    if(!empty($cap_data)) {
                        if ($val['type'] == 3 || $val['type'] == 4) {
                            foreach ($cap_data as $key1 => $val1) {
                                $cap_data[$key1]['t_score'] = "";
                                foreach ($r_ehscorelist as $key2 => $val2) {
                                    if ($val1['questionid'] == $val2['u_questionid']) {
                                        $cap_data[$key1]['t_score'] = $val2['t_score'];
                                        break;
                                    }
                                }
                            }
                            foreach ($cap_data as $key1 => $val1) {
                                $cap_data[$key1]['t_content'] = "";
                                foreach ($r_ehcomment as $key2 => $val2) {
                                    if ($val1['questionid'] == $val2['u_questionid']) {
                                        $cap_data[$key1]['t_content'] = $val2['t_content'];
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    $q_data[$k]= array_merge(array('capquestion'=>$cap_data),$v);
                }else{
                    $q_data[$k]= array_merge(array('capquestion'=>""),$v);
                }
            }
            foreach ($q_data as $kk=>$aa){
                foreach ($r_error as $bb){
                    if(($aa['questionid']==$bb['u_questionid']) || ($aa['questioncap']==1)){
                      //  file_put_contents('E:/log/l' . time() . '.txt', print_r($aa, true), FILE_APPEND);
                        $data[$kk]=$aa;
                    }
                }
            }
            if(!empty($data)) {
                foreach ($data as $key1 => $val1){
                        $data[$key1]['u_answer'] = "";
                        foreach ($r_data as $key2 => $val2) {
                            if ($val1['questionid'] == $val2['u_questionid']) {
                                $data[$key1]['u_answer'] = $val2['u_answer'];
                                break;
                            }
                        }
                    }
                }

            if(!empty($data)) {
                if ($val['type'] == 3 || $val['type'] == 4) {
                    foreach ($data as $key1 => $val1) {
                        $data[$key1]['t_score'] = "";
                        foreach ($r_ehscorelist as $key2 => $val2) {
                            if ($val1['questionid'] == $val2['u_questionid']) {
                                $data[$key1]['t_score'] = $val2['t_score'];
                                break;
                            }
                        }
                    }
                    foreach ($data as $key1 => $val1) {
                        $data[$key1]['t_content'] = "";
                        foreach ($r_ehcomment as $key2 => $val2) {
                            if ($val1['questionid'] == $val2['u_questionid']) {
                                $data[$key1]['t_content'] = $val2['t_content'];
                                break;
                            }
                        }
                    }
                }
            }
            $question_data[$key] = array_merge(array('question' => $data), $val);
        }//取出试题
        $part = array(
            't_data'=>$t_data,
            'starttime'=>time(),
            'question_data'=>$question_data,
            'exam_data'=>$exam_data,
            'eh_data'=>$eh_data,
            'rp'=>$req->get('p',1), //当前页码
            'rk'=>pub::enFormMD5('add'),
            'rop'=>"add"
        );
        //返回值处理或调用模板
        if ( pub::is_mobile() ) {
            return $this->render('errorphonehead', $part);
        }else{
            return $this->render('errorhead', $part);
        }

    }//end of EitdHead
}
