<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Issus;

/* @var $this yii\web\View */
/* @var $model app\modules\CompanyS\models\Restaurant */

$this->title = $model->name;
//导航条
// $this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

  


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'desc:ntext',
            [
            	'attribute'=>'create_at',
            		'value'=>date('Y-m-d H:i:s',$model->create_at),
    		],
        	[
        		'attribute'=>'updated_at',
        			'value'=>date('Y-m-d H:i:s',$model->updated_at),
        		 
        	],
            'address:ntext',
            [
            	'attribute'=>'status',
            		'value'=>Issus::$STATUS[$model->status],
            ],
        	[
        		'attribute'=>'user_id',
        		'value'=>Yii::$app->user->identity->username,
        	],
        ],
    ]) ?>

</div>