<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\CompanyS\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

  


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'desc:ntext',
            'create_at',
            'updated_at',
            'address:ntext',
            'status',
        	[
        		'attribute'=>'user_id',
        		'value'=>Yii::$app->user->identity->username,
        	],
        ],
    ]) ?>

</div>
