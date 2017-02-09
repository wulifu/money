<?php

namespace app\models;

use yii\db\ActiveRecord;

class Money_trend extends ActiveRecord
{
    public static function tableName()
    {
        return 'money_trend';
    }
}