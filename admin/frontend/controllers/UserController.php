<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider; 
use common\models\User;
use yii\data\Pagination;
use yii\db\Query;

/**
 * 会员管理
 */
class UserController extends CommonController
{
	public $layout = 'menu';
    public $enableCsrfValidation = false;
    //分页展示
    public function actionIndex()
    {
    	 $query = new Query();  
         $list = $query->from("user")->all();  
         // var_dump($list);die;  
         $pagination = new Pagination([    
         'totalCount' =>count($list),  
         'pageSize' =>10,//pageSize 每页显示的条数    
        ]);     
         $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();
   
         return $this->renderPartial('user_list',['data'=>$data,'pagination' => $pagination,]);    
     
    }
    //搜索
    public function actionSou()
    {
    	 $b_tim = Yii::$app->request->post('b_time');
      $e_tim = Yii::$app->request->post('e_time');
      $b_time = strtotime($b_tim);
      $e_time = strtotime($e_tim);
    	$username = Yii::$app->request->post('username');
    
    	$query=new Query();
    $query->from('user');
    if (!empty($b_time) && empty($e_time) && empty($username)) {
    	 $query->andFilterWhere(
            ['>','time',$b_time]
        );
    }elseif (!empty($b_time) && !empty($e_time) && empty($username)) {
    	$query->andFilterWhere(
            ['between', 'time', $b_time, $e_time]
        );
    }elseif (!empty($b_time) && !empty($e_time) && !empty($username)) {
    	$query->andFilterWhere(
            ['between', 'time', $b_time, $e_time]
        );
        $query->andFilterWhere(
             ['like', 'username', $username] 
        );
    }elseif (empty($b_time) && !empty($e_time) && empty($username)) {
    	$query->andFilterWhere(
            ['<','time',$e_time]
        );
       
    }elseif (empty($b_time) && !empty($e_time) && !empty($username)) {
    	$query->andFilterWhere(
            ['<','time',$e_time]
        );
         $query->andFilterWhere(
             ['like', 'username', $username] 
        );   
    }elseif (empty($b_time) && empty($e_time) && !empty($username)) {
    
         $query->andFilterWhere(
             ['like', 'username', $username] 
        );
       
    } 
    $list=$query->from('user')->all();
   $pagination = new Pagination([    
         'totalCount' =>count($list),  
         'pageSize' =>10,//pageSize 每页显示的条数    
        ]);     
         $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();

    return $this->renderPartial('user_list',['data'=>$data,'pagination' => $pagination,]);  	
    }
     //删除
    public function actionDel($user_id)
    {
    		$db = \Yii::$app->db->createCommand();
            $res = $db ->delete('user',"user_id=$user_id")->execute();

		     if ($res) 
		     {
		 		$this->redirect('?r=user/index');
		 	 }
    }
    //批量删除
    public function actionDelall()
    {
    	$user_id = $_GET['user_id'];
    	$res = $db = \Yii::$app->db->createCommand();
    	 $res = User::deleteAll("user_id in($user_id)");

		     if ($res) 
		     {
		 		$this->redirect('?r=user/index');
		 	 }
    
    }

}

