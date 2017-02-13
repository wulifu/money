<?php 

namespace frontend\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Money_trend;
use app\models\User;
use frontend\models\Money_trends;
use yii\web\UploadedFile;
use yii\web\Session;

class MoneytrendController extends controller
{
    /* 公共模板 */
	public $layout = false;
    /* 取消数据验证 */
    public $enableCsrfValidation = false;

    /**
     * 资金动向列表
     * @return [type] [description]
     */
    public function actionIndex()
    {
        /* 接收条件值 */
        $request = \Yii::$app->request;
        $data = $request->post();

        /* 分解 */
        $begin_time = isset($data['begin_time']) ? $data['begin_time'] : '';
        $over_time = isset($data['over_time']) ? $data['over_time'] : '';
        $min_money = isset($data['min_money']) ? $data['min_money'] : '';
        $max_money = isset($data['max_money']) ? $data['max_money'] : '';
        $type = isset($data['type']) ? $data['type'] : '3' ;
        $username = isset($data['username']) ? $data['username'] : '';

        /* 验证组合条件 */
        $data = Money_trend::find();
        /* 定义where */
        $where = ['and',];
        /* 搜索用户名 */
        if(!empty($username))
        {
            $info = User::find()->where(['username'=>$username])->asArray()->one();
            $user_id = $info['user_id'];
            $where[] = ['=','user_id',$user_id];
        }
        /* 搜索状态 */
        if($type!='请选择' && $type!=3)
        {
            $where[] = ['=','status',$type];
        }
        /* 搜索时间 */
        if(!empty($begin_time) && !empty($over_time))
        {
            $begin_time = strtotime($begin_time);
            $over_time = strtotime($over_time);
            $where[] = ['between', 'time', $begin_time, $over_time];
        }
        /* 搜索金额 */
        if(!empty($min_money) && !empty($max_money))
        {
            $where[] = ['between', 'money', $min_money, $max_money];
        }

        /* 按条件查询 */
        $list['data'] = $data->where($where)->asArray()->all();
        /* 统计数量 */
        $count = Money_trend::find()->where($where)->count();
        $list['count'] = $count;
        /* 生成分页 */
        $pagination = $this->actionGetpage(3,$count);

        /* 循环取用户名 */
        foreach ($list['data'] as $key => $val) {
            $info = User::find()->where(['user_id'=>$val['user_id']])->asArray()->one();
            $list['data'][$key]['username'] = $info['username'];
        }

        /* 数据分页 */
    	$list['pagination'] = $pagination;

        /* 搜索默认值 */
        $list['username'] = $username;
        if($begin_time !='' && $over_time!='')
        {
            $list['begin_time'] = date('Y-m-d',$begin_time);
            $list['over_time'] = date('Y-m-d',$over_time);
        }
        else
        {
            $list['begin_time'] = date('Y-m-d','1486897140');
            $list['over_time'] = date('Y-m-d','1486897140');
        }

        $list['min_money'] = $min_money;
        $list['max_money'] = $max_money;

    	return $this->render('index',$list);
    }  



    /* 网站资金统计 */
    public function actionMoenycount()
    {

        //  Count  =  网站集资总金额
        //  DayCount1 = 网站当天进账总金额
        //  DayCount2 = 网站当天支出总金额

        /* 查询所有用户余额  计算网站所有资金*/
        $data = User::findBySql('SELECT moeny FROM user')->asArray()->all();
        /* 统计总金额 */
        $count = '';
        foreach ($data as $key => $value) {
            $count+=$value['moeny'];
        }

        /* 处理当天日期 */
        $begin_time=strtotime(date('Y-m-d'));
        $over_time = $begin_time+(60*60*24-1);

        /* 处理条件 */
        $where = [
                    'and',
                    ['status'=>0],
                    ['between', 'time', $begin_time, $over_time]
                ];
        /* 统计当天网站进账金额 */
        $res = Money_trend::find()->where($where)->asArray()->all();
        $Daycount1 = '';
        foreach ($res as $key => $value) {
            $Daycount1+=$value['money'];
        }


        /* 统计当天网站支出金额 */

        // ---------------   待开发 用户返利未做
        $where1 = [
            'and',
            ['status'=>1],
            ['between', 'time', $begin_time, $over_time]
        ];
        $res = Money_trend::find()->where($where1)->asArray()->all();
        $Daycount2 = '';
        foreach ($res as $key => $value) {
            $Daycount2+=$value['money'];
        }


        $list['count'] = $count;    //总额
        $list['profit'] = $Daycount1;//进账
        $list['branch'] = $Daycount2;//支出

        return $this->render('count',$list);
    }


    /**
     * 资金动向记录删除
     * @return [type] [description]
     */
    public function actionDel()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $info = Money_trend::find()->where(['m_id'=>$id])->one();
        $res = $info->delete();
        if($res)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


    /**
     * 批量删除资金动向记录
     * @return [type] [description]
     */
    public function actionDelete()
    {
        $request = \Yii::$app->request;
        $ids = $request->get('ids');
        $res = Money_trend::deleteAll("m_id in ($ids)");
        if($res)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


    /**
     * 分页封装
     * @param  [type] $numPage [每页条数]
     * @param  [type] $count   [数据总条]
     * @return [type]          [分页]
     */
    public function actionGetpage($numPage=5,$count)
    {
        $pagination = new Pagination([
            'defaultPageSize' => $numPage,
            'totalCount' => $count,
        ]);
        return $pagination;
    }

}