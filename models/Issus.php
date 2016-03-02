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
	
	const NORMAL = 0;
	public static $STATUS =  [0=>'正常运行','暂时无法提供服务'];
	
	const TYPE_RESTRANT = 0;
	const TYPE_CPY = 1;
	public static $TYPE = [0=>'饭馆',1=>'普通企业'];
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
            'name' => '名字',
            'desc' => '具体描述',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'address' => '地址',
            'status' => 'Status',
            'type' => 'Type',
            'user_id' => 'User ID',
        ];
    }
}
