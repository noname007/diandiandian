<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpy_member_relateions".
 *
 * @property integer $mem_id
 * @property integer $cpy_id
 * @property integer $type
 */
class CpyMemberRelateions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpy_member_relateions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpy_id', 'type'], 'integer'],
            [['type'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mem_id' => 'Mem ID',
            'cpy_id' => 'Cpy ID',
            'type' => 'Type',
        ];
    }
}
