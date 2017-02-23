<?php 

namespace frontend\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Withdrawals;
use app\models\User;
use app\models\Binging;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\db\Query;
use yii\db\ActiveRecord;

class WithdrawalsController extends controller
{
    /* 公共模板 */
	public $layout = false;
    /* 取消数据验证 */
    public $enableCsrfValidation = false;


    /**
     * 提现待审核列表
     * @return [type] [description]
     */
    public function actionIndex()
    {

    	/* 接收搜索值 */
    	$request = \Yii::$app->request;
        $data = $request->post();

        /* 处理条件值 */
        $begin_time = isset($data['begin_time']) ? $data['begin_time'] : '' ;
        $over_time = isset($data['over_time']) ? $data['over_time'] : '' ;

        /* 验证数据生成条件 */
        if(!empty($begin_time) && !empty($over_time))
        {
        	$begin_time = strtotime($begin_time);
        	$over_time = strtotime($over_time);
        	$where = ['and', 'status=0',['between', 'time', $begin_time, $over_time]];
        	/* 统计数量 */
            $count = Withdrawals::find()->where($where)->count();
            /* 生成分页 */
            $pagination = $this->actionGetpage(3,$count);
        }
        else
        {
        	$where = ['status'=>0];
        	/* 统计数量 */
            $count = Withdrawals::find()->where($where)->count();
            /* 生成分页 */
            $pagination = $this->actionGetpage(3,$count);
        }

        /* 查询数据 */
		$list['data'] = Withdrawals::find()
		->where($where)
		->offset($pagination->offset)
        ->limit($pagination->limit)
        ->asArray()
        ->all();

        /* 统计数据量 */
		$list['count'] = Withdrawals::find()->where($where)->count();

		/* 搜索默认值 */
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

		/* 查询用户名 银行卡号 处理数组*/
		foreach ($list['data'] as $key => $value) {
			$list['data'][$key]['username'] = implode(User::findBySql('SELECT username FROM user')->where(['user_id'=>$value['user_id']])->asArray()->one());
			$list['data'][$key]['card_num'] = implode(Binging::findBySql('SELECT card_num FROM binging')->where(['bind_id'=>$value['band_id']])->asArray()->one());
		}

        /* 数据分页 */
        $list['pagination'] = $pagination;
    	return $this->render('index',$list);
    }


    /* 审核通过状态 */
    public function actionUpdata()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $user_id = $request->get('user_id');
        $info = Withdrawals::find()->where(['w_id'=>$id])->one();
        $info->status = 1;
        $res = $info->save();
        if($res){
            echo 1;
            /* 入库资金动向 */
            $db = \Yii::$app->db->createCommand();
            $arr = array('user_id' => $user_id,
                        'money' => $info['money'], 
                        'time' => time(), 
                        'status' => '1', 
            );
            $db->insert('money_trend',$arr)->execute();
        }else{
            echo 0;
        }
    }


    /* 审核失败调用模板 */
    public function actionTemplate()
    {
        $request = \Yii::$app->request;
        $list['id'] = $request->get('id');
        $list['user_id'] = $request->get('user_id');
        return $this->render('edit',$list);
    }


    /* 审核失败方法 */
    public function actionUpdatemsg()
    {
        $request = \Yii::$app->request;
        $data = $request->get();
        $content = $data['content'];
        $id = $data['id'];
        $user_id = $data['user_id'];
        $info = Withdrawals::find()->where(['w_id'=>$id])->one();
        $info->msg = $content;
        $info->status = 2;
        $res = $info->save();
        if($res)
        {
            $result = User::find()->where(['user_id'=>$user_id])->one();
            $result->money = $info['money'] + $result['money'];
            $result->save();
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
