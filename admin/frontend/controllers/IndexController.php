<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use app\models\Admin;
use yii\db\Query;
/**
 * 首页
 */
class IndexController extends CommonController
{
    public $layout = 'menu';
    public function actionIndex(){
    	
    	 $admin = Yii::$app->session['admin'];
    	$res = Admin::find()->where(['admin' => $admin])->asArray()->one();   
       return $this->renderPartial('index.html',$res);
    }
    public function actionWelcome(){
    	 $admin = Yii::$app->session['admin'];
    	 $data = Admin::find()->where(['admin' => $admin])->asArray()->one();   
    	   $query = new Query();  
         $list = $query->from("admin_log")->all();  
          //
 krsort($list);

        
         // 、、eturn $this->renderPartial('admin_log');    
        return $this->renderPartial('welcome',$data,['list'=>$list,]);
    }
}