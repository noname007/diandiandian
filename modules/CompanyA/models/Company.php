<?php

namespace app\modules\CompanyA\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_at
 * @property integer $updated_at
 * @property string $desc
 * @property string $address
 * @property integer $status
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_at', 'updated_at', 'address'], 'required'],
            [['create_at', 'updated_at', 'status'], 'integer'],
            [['desc', 'address'], 'string'],
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
            'desc' => 'Desc',
            'address' => 'Address',
            'status' => 'Status',
        ];
    }
}
