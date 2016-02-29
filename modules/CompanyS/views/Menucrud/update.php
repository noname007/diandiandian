<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\CompanyS\models\RestaurantMenu */

$this->title = 'Update Restaurant Menu: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="restaurant-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
