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
 * 管理员登陆
 */

class LoginController extends Controller
{
	public $enableCsrfValidation = false; 
	public function actionIndex()
	    {
	         
	         return $this->renderPartial('login');    
	 
	    }
	    public function actionLogins()
	    { 
	    	$data = Yii::$app->request->post();

	    	$re = Admin::find()->andWhere(['admin' => $data['username'], 'password' => $data['pass']])->count('a_id');
	    	
	      
	       if ($re == 1) {
	 		$da = Admin::find()->where(['admin' => $data['username']])->asArray()->one();
	       	$land = $da['land'] + 1;
	       $reip=$_SERVER["REMOTE_ADDR"]; 
	       $time_last = strtotime(date('Y-m-d H:i:s'));
	       $datas = array('reip' => $reip,
	       					'time_last' => $time_last,
	       					'land' => $land,
	       							 ); 

	       $session = Yii::$app->session;
			$session['admin']=$data['username'];
			$admin = $data['username'];
			$res = $db=\Yii::$app->db ->createCommand()->update('admin',$datas,"admin = '$admin'") ->execute(); 

	     $this->message('登陆成功','?r=index/index',1,1);
	       }else
	       {
	       	 $this->message('登录名或密码错误','?r=login/index',1,0);
	       }
	 
	    }
	    //推出 登陆
	    public function actionOut()
	    {
	    	$session = Yii::$app->session;
	    	$session->remove('admin');
	    	$this->message('请稍后...','?r=login/index',1,1);
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
