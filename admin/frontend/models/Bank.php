<?php

namespace app\models;

use yii\db\ActiveRecord;

class Bank extends ActiveRecord
{
    public static function tableName()
    {
        return 'bank';
    }
}