<?php

namespace app\modules\CompanyS\models;

use Yii;

/**
 * This is the model class for table "restaurant_menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_at
 * @property integer $updated_at
 * @property integer $restaurant_id
 * @property integer $money
 * @property string $desc
 * @property integer $status
 */
class RestaurantMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_at', 'updated_at', 'restaurant_id', 'money'], 'required'],
            [['create_at', 'updated_at', 'restaurant_id', 'money', 'status'], 'integer'],
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
            'updated_at' => '最后更新时间',
            'restaurant_id' => '餐馆ID',
            'money' => '菜单价（分为单位）',
            'desc' => '菜品描述',
            'status' => '状态',
        ];
    }
}
