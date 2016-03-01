<?php
namespace  app\models;

class MenuForm extends Menu
{
	public  function  rules(){
		return [
				[['name', 'money'], 'required'],
				[['money',], 'integer'],
				[['desc'], 'string'],
				[['name'], 'string', 'max' => 255],
		];
	}
	
}