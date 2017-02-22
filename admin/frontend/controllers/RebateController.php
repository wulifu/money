<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Finance_project;
use yii\db\Query;

/**
 * 返利模块
 */
class RebateController extends Controller
{
    public $layout = 'menu';

    /**
     * 给所有用户返利
     * @return [type] [description]
     */
    public function actionIndex(){

    	ini_set('memory_limit', '250M'); //内存限制
		set_time_limit(60*10); //执行时间限制

		//取出当前收益利率
		$rate = 4; //模拟
		$day_rate = $rate / 365;

    	$userDb = new User();
        $data = $userDb->find()->where(['>','money','1'])->all();
        foreach($data as $k => $v){
            $alter = $v->money*$day_rate;
            $data[$k]->money = $v->money + $alter;
            if($data[$k]->save()){
                $record[] = ['user_id'=>$v->user_id,'money'=>$alter,'time'=>time(),'status'=>2];
            }else{
                $error[] = ['user_id'=>$v->user_id];
            }
            unset($data[$k]);
        }
        if(isset($record)){
            $re =Yii::$app->db->createCommand()
                ->batchInsert('money_trend',['user_id','money','time','status'],
                    $record)
                ->execute();
        }

    }

    public function actionProject(){
        $finance_projectDb = new Finance_project();
        $data = $finance_projectDb->find()->where(['status'=>'1'])->asArray()->all();
        print_r($data);
    }


}