<?php

namespace app\models;

use yii\db\ActiveRecord;

class Withdrawals extends ActiveRecord
{
    public static function tableName()
    {
        return 'withdrawals';
    }
}