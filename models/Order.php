<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $cpy_id
 * @property integer $memu_id
 * @property integer $restaurant_id
 * @property integer $create_at
 * @property integer $money
 * @property integer $updated_at
 * @property integer $status
 * @property string $desc
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpy_id', 'memu_id', 'restaurant_id', 'create_at', 'money', 'updated_at'], 'required'],
            [['cpy_id', 'memu_id', 'restaurant_id', 'create_at', 'money', 'updated_at', 'status'], 'integer'],
            [['desc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cpy_id' => 'Cpy ID',
            'memu_id' => 'Memu ID',
            'restaurant_id' => 'Restaurant ID',
            'create_at' => 'Create At',
            'money' => 'Money',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'desc' => 'Desc',
        ];
    }
}
