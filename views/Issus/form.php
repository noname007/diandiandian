<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Issus;
/* @var $this yii\web\View */

$this->title= "添加组织";
?>

 <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'fillinfo-form','action'=>'/issus/create']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'desc')->textArea(['rows' => 6]) ?>


                    <?= $form->field($model, 'address')->textArea(['rows' => 6]) ?>
                    
                     <?= $form->field($model, 'type')->textArea(['rows' => 6])->radioList(Issus::$TYPE) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>