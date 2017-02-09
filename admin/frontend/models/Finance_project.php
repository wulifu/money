<?php

namespace app\models;

use yii\db\ActiveRecord;

class Finance_project extends ActiveRecord
{
    public static function tableName()
    {
        return 'finance_project';
    }
}