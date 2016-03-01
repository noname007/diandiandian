<?php
namespace app\models;

class FillIssusInfo extends Issus
{
// 	public $verifyCode;
	
	function  rules()
	{
	
		return [
				// name, email, subject and body are required
				[['name', 'desc', 'address','type'], 'required'],
		
				[['type'], 'integer'],
				[['desc', 'address'], 'string'],
				[['name'], 'string', 'max' => 255],
				[['name'], 'unique'],
				// verifyCode needs to be entered correctly
// 				['verifyCode','captcha','message'=>'验证码错误'],
				
			
		];
	}
	
	public function attributeLabels()
	{
		return  [
				'name'=>'公司名字',
				'desc'=>'详细描述',
				'address'=>'所在地址',
				'verifyCode' => '验证码',
				'type'=>'类型',
				'user_id'=>'用户名',
				'create_at' =>'创建时间',
				'updated_at'=>'更新时间',
				'status'=>'状态',
		];
	}
}