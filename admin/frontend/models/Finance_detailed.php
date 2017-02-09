<?php

namespace app\models;

use yii\db\ActiveRecord;

class Finance_detailed extends ActiveRecord
{
    public static function tableName()
    {
        return 'finance_detailed';
    }
}