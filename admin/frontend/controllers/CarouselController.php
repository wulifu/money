<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;

/**
 * 轮播管理
 */
class CarouselController extends Controller
{
    public $layout = 'menu';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->renderPartial('banner_list');
    }
    public function actionAdd(){
        return $this->renderPartial('banner_add');
    }
    public function actionEdit(){
        return $this->renderPartial('banner_edit');
    }
    //添加信息
    public function actionAdd_list(){
        var_dump($_FILES);
        var_dump($_POST);
    }

}