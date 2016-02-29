<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\CompanyS\models\RestaurantMenu */

$this->title = 'Create Restaurant Menu';
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
