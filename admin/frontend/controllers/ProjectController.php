<?php
namespace frontend\controllers;

use Yii;
use app\models\Finance_project;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\models\Finance_detailed;
use app\models\User;
use yii\db\Query;

header("content-type:text/html;charset=utf-8");
/**
 * 投资项目管理
 */
class ProjectController extends Controller
{
    public $layout = 'menu';
    public $enableCsrfValidation = false;
    /**
     * @author:昊
     * @content:项目添加
     */
    public function actionAdd()
    {
        return $this->renderPartial('project_add');
    }
    public function actionAdd_list(){
        $data=yii::$app->request->post();
        $res=yii::$app->db->createCommand()->insert('finance_project',['pro_name'=>$data['pro_name'],'yield'=>$data['yield']
         ,'term'=>$data['term'],'money'=>$data['money'], 'release_time'=>time(),'rebate_time'=>$data['rebate_time'],
         'product_brief'=>$data['product_brief'], 'interest_rule'=>$data['interest_rule'],
          'due_process'=>$data['due_process'],'investment_dsc'=>$data['investment_dsc']])->execute();
        if($res){
             //adtion 0登陆 1添加 2修改 3删除 
          //type 0用户 1操作

            $db = \Yii::$app->db->createCommand();
          $log = array('admin' => Yii::$app->session['admin'], 
                        'action' => 1, 
                        'type' => 1, 
                        'time' => strtotime(date('Y-m-d H:i:s')), 
                        'object' => $data['pro_name'], 
                        'content' => '项目列表', 

              );       

          $a=$db->insert('admin_log',$log)->execute();
        
             return $this->redirect('?r=project/index');
        }else{
            return $this->redirect('?r=project/add');
        }
    }
    /**
     * @author:昊
     * @content:项目展示
     */
    public function actionIndex(){
        $user=Finance_project::find();
        $data=yii::$app->request->get();
        /**
         * 多条件搜素
         */
        if(!empty($data['name'])){
            $name=trim($data['name']);
            $user->andFilterWhere(['like', 'pro_name',$name]);
            $name=$name;
        }else{
            $name="";
        }
        if(!empty($data['money_min'])&& !empty($data['money_max']))
        {
            //判断是否为纯数字
            if(is_numeric($data['money_min'])&&is_numeric($data['money_max'])){
            $money_min=trim($data['money_min']);
            $money_max=trim($data['money_max']);
            $user->orWhere("money BETWEEN $money_min AND $money_max");
            }else{
            $money_min=trim($data['money_min']);
            $money_max=trim($data['money_max']);
            }
        }
        else if(!empty($data['money_min'])){
            $money_min=trim($data['money_min']);
            $money_max="";
            if(is_numeric($money_min)){
                $user->orWhere("money >$money_min ");
            }else{
                $money_min=trim($data['money_min']);
            }
        }else if(!empty($data['money_max'])){
            $money_max=trim($data['money_max']);
            $money_min="";
            if(is_numeric($money_max)){
                $user->orWhere("money <$money_max ");
            }else{
                $money_max=trim($data['money_max']);
            }
        }
        else{
            $money_min="";
            $money_max="";
        }

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $user->count(),
        ]);
        $user->select=array('pro_name','yield','fin_id','term','money','status','release_time','rebate_time');
        $countries = $user
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
             $money_sum=array();
             foreach($countries as $key =>$val)
             {
                   $res=Finance_detailed::find()->select('money')->where(['fin_id'=>$val['fin_id']])->asArray()->all();
                   $money_sum[$key]=0;
                   foreach($res as $v){
                       $money_sum[$key]+=$v['money'];
                   }
                   $countries[$key]['money_sum']=$money_sum[$key];
             }
        return $this->renderPartial('index', [
            'arr' => $countries,
            'pagination' => $pagination,
            'name'=>$name,
            'money_min'=>$money_min,
            'money_max'=>$money_max
        ]);
    }
    /**
     * @author:昊
     * @content:项目删除
     */
    public function actionDelete(){
        $fin_id=yii::$app->request->get('fin_id');
        $user=Finance_project::deleteAll('fin_id in ('."$fin_id".')');
        if($user){
               //adtion 0登陆 1添加 2修改 3删除 
          //type 0用户 1操作
            $db = \Yii::$app->db->createCommand();
          $log = array('admin' => Yii::$app->session['admin'], 
                        'action' => 3, 
                        'type' => 1, 
                        'time' => strtotime(date('Y-m-d H:i:s')), 
                        'object' => 'id='.$fin_id, 
                        'content' => '项目列表', 

              );       
          $db->insert('admin_log',$log)->execute();
            echo 1;
        }else{
            echo 0;
        }
    }
    /**
     * @author:昊
     * @content:投资记录清单
     */
    public function actionList(){
        $fin_id=yii::$app->request->get('fin_id');
        $user=Finance_detailed::find();
        $user->select=array('money','time','user_id');
        $res=$user->where(['fin_id'=>$fin_id])->asArray()->all();
        foreach($res as $key=>$val) {
            $arr = User::find()->select('phone')->where(['user_id' => $val['user_id']])->asArray()->all();
            if (!empty($arr)) {
                $res[$key]['phone'] = $arr[0]['phone'];
            }
        }
        return $this->renderPartial('list', [
            'res' => $res,
        ]);
    }
    /**
     * @author:昊
     * @content:修改状态
     */
    public function actionUpdate(){
        $fin_id=yii::$app->request->get('fin_id');
        $res=yii::$app->db->createCommand()->update('finance_project',['status'=>2],"fin_id='$fin_id'")->execute();
             yii::$app->db->createCommand()->update('finance_detailed',['status'=>2],"fin_id='$fin_id'")->execute();
        if($res){
          //adtion 0登陆 1添加 2修改 3删除
          //type 0用户 1操作
          $db = \Yii::$app->db->createCommand();
          $log = array('admin' => Yii::$app->session['admin'], 
                        'action' => 2, 
                        'type' => 1, 
                        'time' => strtotime(date('Y-m-d H:i:s')), 
                        'object' => 'id='.$fin_id, 
                        'content' => '项目状态', 

              );       
          $db->insert('admin_log',$log)->execute();
            echo 1;
        }
    }
}