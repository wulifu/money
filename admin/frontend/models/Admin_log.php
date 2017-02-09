<?php

namespace app\models;

use yii\db\ActiveRecord;

class Admin_log extends ActiveRecord
{
    public static function tableName()
    {
        return 'admin_log';
    }
}