<?php

namespace app\modules\CompanyS\models;

use Yii;
/**
 * This is the model class for table "restaurant".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $create_at
 * @property integer $updated_at
 * @property string $address
 * @property integer $status
 * @property integer $user_id
 */
class Restaurant extends \app\models\Company
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * @inheritdoc
     */
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '餐馆名字',
            'desc' => '餐馆描述',
            'create_at' => '创建时间',
            'updated_at' => '更新时间',
            'address' => '餐馆地址',
            'status' => '餐馆状态',
            'user_id' => '创建者',
        ];
    }
}
