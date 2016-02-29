<?php
namespace app\modules\CompanyS\models;
use yii\base\Model;

class Fillrestaurantinfo extends Model{
	public $verifyCode;
	public $type;
	public $name;
	public $desc;
	public $address;
	public $status;
	
	public function rules()
	{
		return [
				// name, email, subject and body are required
				[['name', 'desc', 'address','type'], 'required'],
// 				[['name'],'unique'],
				// verifyCode needs to be entered correctly
				['verifyCode','captcha'],
		];
	}
	
	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return  [
				'name'=>'公司名字', 
				'desc'=>'详细描述',
				'address'=>'所在地址', 
				'verifyCode' => '验证码',
				'type'=>'类型',
		];
	}
}