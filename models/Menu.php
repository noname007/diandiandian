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
	public static  $STATUS=['在售','已售完'];
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
            'name' => '菜名',
            'create_at' => '创建时间',
            'updated_at' => '更新时间',
            'restaurant_id' => '餐馆',
            'user_id' => '创建者',
            'money' => '菜价(RMB单位:分)',
            'desc' => '详细描述此菜',
            'status' => '是否在售',
        ];
    }
}
