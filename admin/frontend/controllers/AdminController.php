<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;

/**
 * 轮播管理
 */
class AdminController extends Controller
{
    public $layout = 'menu';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
   return $this->renderPartial('admin_list');
    }
    public function actionAdd(){
        return $this->renderPartial('admin_add');
    }
    
    public function actionAdds(){
        $data = Yii::$app->request->post();
        var_dump($data);
        $db = \Yii::$app->db->createCommand();
        $res = $db->insert('admin',$data)->execute();
        if ($res) {
          return  $this->redirect('?r=admin/index');
        }
    }
   

}