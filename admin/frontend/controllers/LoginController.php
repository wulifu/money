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
	     $this->message('登陆成功','?r=index/index',1,1);
	       }else
	       {
	       	 $this->message('登录名或密码错误','?r=login/index',1,0);
	       }
	 
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
       die( $this->renderPartial('login_mes',$data)  );

     }
    
}
