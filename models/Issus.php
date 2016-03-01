<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "issus".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $create_at
 * @property integer $updated_at
 * @property string $address
 * @property integer $status
 * @property integer $type
 * @property integer $user_id
 */
class Issus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'create_at', 'updated_at', 'address', 'type', 'user_id'], 'required'],
            [['id', 'create_at', 'updated_at', 'status', 'type', 'user_id'], 'integer'],
            [['desc', 'address'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'address' => 'Address',
            'status' => 'Status',
            'type' => 'Type',
            'user_id' => 'User ID',
        ];
    }
}
