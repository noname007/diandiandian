<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
?>

 <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'fillinfo-form','action'=>'/cs/restaurantcrud/create']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'desc')->textArea(['rows' => 6]) ?>

                    <?= $form->field($model, 'status') ?>

                    <?= $form->field($model, 'address')->textArea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>