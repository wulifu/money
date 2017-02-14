<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider; 
use app\models\Admin;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\UploadedFile;  

/**
 * 管理员管理
 */
class AdminController extends CommonController
{
    public $layout = 'menu';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
         $query = new Query();  
         $list = $query->from("admin")->all();  
         // var_dump($list);die;  
         $pagination = new Pagination([    
         'totalCount' =>count($list),  
         'pageSize' =>2,//pageSize 每页显示的条数    
        ]);     
         $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();
   
         return $this->renderPartial('admin_list',['data'=>$data,'pagination' => $pagination,]);    
 
    }
    public function actionAdd(){
        return $this->renderPartial('admin_add');
    }
    
    public function actionAdds(){
        $data = Yii::$app->request->post();
        $admin = Yii::$app->request->post('admin');
        $da = Admin::find()->where(['admin' => $admin])->one();
        if (!empty($da)) {
           $this->message('登录名已存在','?r=admin/index',1,0);die;
        }

        //文件上传
    
        //首先判断是否是POST提交，不是post提交的输出4
        if(\Yii::$app->request->isPost) {
            //接收图片的信息值
            $image = UploadedFile::getInstanceByName('photo');
            //可以打印看看

            //上传目录，进行命名
            $dir='uploads/';
            //这个文件要创建到web的目录下
            //文件的绝对路径
            $name = $dir.time().$image->name;
            //保存文件函数，在手册上有，将图片保存到本地
            // var_dump($name);die;
            $status = $image->saveAs($name,true);
            $data['photo'] = $name;
          
    }else{
            $this->message('文件错误','?r=admin/index',1,0);die;
        }
 
        
        
     
        $db = \Yii::$app->db->createCommand();
        $res = $db->insert('admin',$data)->execute();
        if ($res) {
          //adtion 0登陆 1添加 2修改 3删除 
          //type 0用户 1操作
          $log = array('admin' => Yii::$app->session['admin'], 
                        'action' => 1, 
                        'type' => 1, 
                        'time' => strtotime(date('Y-m-d H:i:s')), 
                        'object' => $data['admin'], 
                        'content' => '管理员', 

              );
                 
$db->insert('admin_log',$log)->execute();


          $this->message('新建成功','?r=admin/index',1,1);
        }
    }
    //删除
    public function actionDel($a_id){
      $db = \Yii::$app->db->createCommand();
            $res = $db ->delete('admin',"a_id=$a_id")->execute();

         if ($res) 
         {
        $this->message('删除成功','?r=admin/index',1,1);
       }else
       {
        $this->message('删除失败','?r=admin/index',1,0);
       }

    }
     //批量删除
    public function actionDelall()
    {
      $a_id = $_GET['a_id'];
   
      $res = $db = \Yii::$app->db->createCommand();
       $res = Admin::deleteAll("a_id in($a_id)");

         if ($res) 
         {
        $this->redirect('?r=admin/index');
       }
    
    }
    //修改
     public function actionEdit()
    {

      $a_id = $_GET['a_id'];
       $res = Admin::find()->where(['a_id' => $a_id])->asArray()->one();   
    // var_dump($res);die;
       if ($res) {
         return  $this->renderPartial('admin_edit',$res);
       }else
       {
         $this->message('未找到','?r=admin/index',1,0);
       }
      
    }
    //修改提交
    public function actionEdits()
    {

    $a_id = Yii::$app->request->post('a_id');
     $data = Yii::$app->request->post();

     $da = Admin::find()->where(['admin' => $data['admin']])->asArray()->one();
    $dat = Admin::find()->where(['a_id' => $data['a_id']])->asArray()->one();
        if (!empty($da) && $da['admin'] != $data['admin']) {
           $this->message('登录名已存在','?r=admin/index',1,0);die;
        }
      //文件上传 
        $image = UploadedFile::getInstanceByName('photo');
        if (empty( $image)) {
           $data['photo'] = $dat['photo'];     
        }else
        {
                  if(\Yii::$app->request->isPost) {
              //接收图片的信息值
              $image = UploadedFile::getInstanceByName('photo');
              //可以打印看看
  // var_dump($image);die;
              //上传目录，进行命名
              $dir='uploads/';
              //这个文件要创建到web的目录下x`
              //文件的绝对路径
              $name = $dir.time().$image->name;
              //保存文件函数，在手册上有，将图片保存到本地
              // var_dump($name);die;
              $status = $image->saveAs($name,true);
              $data['photo'] = $name;
            
      }else{
              $this->message('文件错误','?r=admin/index',1,0);die;
          }
        }
        

// var_dump($dat);
// var_dump($data);die;
     $res = $db=\Yii::$app->db ->createCommand()->update('admin',$data,"a_id = $a_id") ->execute(); 
  
       if ($res == 1) {
         $this->message('修改成功','?r=admin/index',1,1);
       }else
       {
         $this->message('修改失败','?r=admin/index',1,0);
       }
      
    }

        //搜索
    public function actionSou()
    {
      $b_tim = Yii::$app->request->post('b_time');
      $e_tim = Yii::$app->request->post('e_time');
      $b_time = strtotime($b_tim);
      $e_time = strtotime($e_tim);
      $username = Yii::$app->request->post('username');
  //  var_dump($b_time);die;
      $query=new Query();
    $query->from('admin');
    if (!empty($b_time) && empty($e_time) && empty($username)) {
       $query->andFilterWhere(
            ['>','time_res',$b_time]
        );
    }elseif (!empty($b_time) && !empty($e_time) && empty($username)) {
      $query->andFilterWhere(
            ['between', 'time_res', $b_time, $e_time]
        );
    }elseif (!empty($b_time) && !empty($e_time) && !empty($username)) {
      $query->andFilterWhere(
            ['between', 'time_res', $b_time, $e_time]
        );
        $query->andFilterWhere(
             ['like', 'admin', $username] 
        );
    }elseif (empty($b_time) && !empty($e_time) && empty($username)) {
      $query->andFilterWhere(
            ['<','time_res',$e_time]
        );
       
    }elseif (empty($b_time) && !empty($e_time) && !empty($username)) {
      $query->andFilterWhere(
            ['<','time_res',$e_time]
        );
         $query->andFilterWhere(
             ['like', 'admin', $username] 
        );   
    }elseif (empty($b_time) && empty($e_time) && !empty($username)) {
    
         $query->andFilterWhere(
             ['like', 'admin', $username] 
        );
       
    } 
    $list=$query->from('admin')->all();
   $pagination = new Pagination([    
         'totalCount' =>count($list),  
         'pageSize' =>2,//pageSize 每页显示的条数    
        ]);     
         $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();

    return $this->renderPartial('admin_list',['data'=>$data,'pagination' => $pagination,]);    
    }

    public function actionLog()
    {
          $query = new Query();  
         $list = $query->from("admin_log")->all();  
          //
 krsort($list);

         $pagination = new Pagination([    
         'totalCount' =>count($list),  
         'pageSize' =>10,//pageSize 每页显示的条数    
        ]);     
         $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();
   //   
          krsort($data);
         // 
         return $this->renderPartial('admin_log',['data'=>$data,'pagination' => $pagination,]);    

    }



     /**
       * [message 消息页面]
       *
       * @author Itkai
       *
       * @param  string $msg  [消息]
       * @param  string $url  [跳转页面]
       * @param  int    $wait [跳转时间]
       * @param  int    $type [成功 or 失败]
       *
       * @return [type] [description]
       */
     public function message($msg='请先登录',$url='adminindex',$wait=1,$type=0)
     {
    $data = [
        'title'=> '提示消息',
        'msg' => $msg,
        'url' => $url,
        'wait'=> $wait,
        'type'=> $type
    ];

       if ($type == 0) 
       {
            $data['title'] = '错误消息';
       }
       if (empty($url)) 
       {
             $data['url'] = "javascript:history.back(-1);";
       }
       die( $this->renderPartial('mes',$data)  );

     }
    

}