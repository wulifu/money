<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;

/**
 * 非法登陆
 */
class CommonController extends Controller
{
	 public $layout = 'menu';
    public $enableCsrfValidation = false;
    public function init(){

     	if (!isset(Yii::$app->session['admin'])) {
     	$this->message('请先登陆','?r=login/index',1,0);
     	}

    }


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
     //  var_dump($data);die;
       die( $this->renderPartial('mes',$data)  );

     }
    
    
}