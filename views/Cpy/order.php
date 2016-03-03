<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title= "菜单";
?>

 <div class="row">
    <div class="col-lg-5">
		<?php if(!empty($menus)):?>
            <?php $form = ActiveForm::begin(['id' => 'order-food-form','action'=>'/cpy/order_foods']); ?>
    			<?php $form ?>
    			
                <?= $form->field($model, 'menus')->checkboxList(ArrayHelper::map($menus, 'id','name'))->label('菜品'); ?>
    
             
                <div class="form-group">
                    <?= Html::submitButton('订餐', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
    
            <?php ActiveForm::end(); ?>
       	<?php else: ?>
       		暂时无法点餐，请联系公司主管
       	<?php endif;?>

    </div>
</div>