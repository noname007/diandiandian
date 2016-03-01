<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
        	[
        		'attribute'=>'create_at',
        		'value'=>date('Y-m-d H:i:s',$model->create_at),
        	],
        	[
        		'attribute'=>'updated_at',
        		'value'=>date('Y-m-d H:i:s',$model->updated_at),
        				 
        	],
        	[
        		'attribute'=>'status',
        		'value'=>Menu::$STATUS[$model->status],
        	],
        	[
        			'attribute'=>'user_id',
        			'value'=>Yii::$app->user->identity->username,
        	],
            'money',
            'desc:ntext',
        ],
    ]) ?>

</div>
