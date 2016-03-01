<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_at
 * @property integer $updated_at
 * @property integer $restaurant_id
 * @property integer $user_id
 * @property integer $money
 * @property string $desc
 * @property integer $status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_at', 'updated_at', 'restaurant_id', 'money'], 'required'],
            [['create_at', 'updated_at', 'restaurant_id', 'user_id', 'money', 'status'], 'integer'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'restaurant_id' => 'Restaurant ID',
            'user_id' => 'User ID',
            'money' => 'Money',
            'desc' => 'Desc',
            'status' => 'Status',
        ];
    }
}
