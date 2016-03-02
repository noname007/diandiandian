<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '餐馆';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'desc:ntext',
            'address:ntext',
            [
              
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add} ',
                'buttons'=>[
                    'add'=>function ($url, $model,$key){
                            return Html::a('使用',$url);
                    }
                    	
                ],
            ],
//             ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);  ?>
<?php Pjax::end(); ?></div>
