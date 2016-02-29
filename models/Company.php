<?php
namespace app\models;

class Company extends \yii\db\ActiveRecord
{
	const NORMAL = 1;
	const BANNED = 2;
	
	public function rules()
	{
		return [
				[['name', 'create_at', 'updated_at', 'address', 'user_id'], 'required'],
				[['create_at', 'updated_at', 'status'], 'integer'],
				[['desc', 'address'], 'string'],
				[['name'], 'string', 'max' => 255],
				[['name'],'unique'],
		];
	}
	public function attributeLabels()
	{
		return [
				'id' => 'ID',
				'name' => '名字',
				'desc' => '详细描述',
				'create_at' => '创建时间',
				'updated_at' => '更新时间',
				'address' => '所在地址',
				'status' => '状态',
				'user_id' => '创建者',
		];
	}
}