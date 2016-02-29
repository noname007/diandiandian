<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\CompanyS\models\RestaurantMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'create_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'restaurant_id') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
