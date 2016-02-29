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
 */
class Restaurant extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['name', 'create_at', 'updated_at', 'address'], 'required'],
            [['desc', 'address'], 'string'],
            [['create_at', 'updated_at', 'status'], 'integer'],
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
        ];
    }
}
