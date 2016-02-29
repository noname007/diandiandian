<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\CompanyS\models\RestaurantMenu */

$this->title = '添加新菜品';
$this->params['breadcrumbs'][] = ['label' => '菜品中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
