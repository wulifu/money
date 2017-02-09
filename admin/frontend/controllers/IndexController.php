<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;

/**
 * 首页
 */
class IndexController extends Controller
{
    public $layout = 'menu';
    public function actionIndex(){
       return $this->renderPartial('index.html');
    }
    public function actionWelcome(){
        return $this->renderPartial('welcome.html');
    }
}