<?php

namespace app\models;

use yii\db\ActiveRecord;

class Binging extends ActiveRecord
{
    public static function tableName()
    {
        return 'binging';
    }
}