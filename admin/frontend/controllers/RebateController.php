<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Finance_project;
use yii\db\Query;
use app\models\Finance_detailed;
header("content-type:text/html;charset=utf-8");

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
		$day_rate = $rate / 365/100;

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
    /**
     * @author:昊
     * @content:计算项目回款利率
     * @content: 先判断该项目是否完成募捐,项目是否有用户投资,根据用户投资时间到募款结束期限通过日利率计算本金返款
     */
    public function actionProject(){
        $finance_projectDb = new Finance_project();
        $user = $finance_projectDb->find()->where(['status'=>'2']);
        $user->select=array('yield','fin_id','release_time','rebate_time','term');
        $data=$user ->asArray()->all();
        if($data){
            foreach($data as $k=>$v){
                //计算项目的日利率
                $day_yield=round($v['yield']/12/30,3);
                //查询投资用户
                $user_id=Finance_detailed::find();
                $user_id->where(['fin_id'=>$v['fin_id'],'status'=>2]);
                $user_id->select=array('money','time','user_id');
                $user_money=$user_id->asArray()->all();
                foreach($user_money as $key=>$val){
                    //计算利息
                    $profit=round($val['money']*$day_yield*($v['release_time']/24/3600+$v['term']-$val['time']/24/3600-$v['rebate_time']),2);
                    $money_profit=$val['money']+$profit[$key][$val['user_id']];
                    ///资金入库记录
                    yii::$app->db->createCommand()->insert('finance_detailed',['user_id'=>$val['user_id']
                        ,'fin_id'=>$v['fin_id'],'money'=>$money_profit, 'time'=>$val['time'], 'profit'=>$profit,'status'=>3,])->execute();
                    //用户流水账
                    yii::$app->db->createCommand()->insert('money_trend',['user_id'=>$val['user_id']
                        ,'money'=>$money_profit, 'time'=>time(),'status'=>4])->execute();
                }
                //修改状态2
                yii::$app->db->createCommand()->update('finance_detailed',['status'=>0],"status='2'")->execute();
            }
        }
    }


}