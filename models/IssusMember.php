<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "issus_member".
 *
 * @property integer $issus_id
 * @property integer $user_id
 */
class IssusMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issus_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issus_id', 'user_id'], 'required'],
            [['issus_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'issus_id' => 'Issus ID',
            'user_id' => 'User ID',
        ];
    }
}
