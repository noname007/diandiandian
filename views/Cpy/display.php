<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var boolen isFindRest  */


$this->title = ($isFindRest?'查找':'供餐').'餐馆';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php // Pjax::begin(); ?>


<?php 
$column =[ 
    ['class' => 'yii\grid\SerialColumn'],
    'name',
    'desc:ntext',
    'address:ntext',

];

if ($isFindRest){
    $column[] =  [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{add} ',
        'buttons'=>[
            'add'=>function ($url, $model,$key){
                return Html::a('使用',$url);
            }
        ],
    ];
}else{
    $column[] =  [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{del} ',
        'buttons'=>[
            'del'=>function ($url, $model,$key){
                 return Html::a('删除',$url);
            }
        ],
   ];
}


?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $column,
    ]);  ?>
<?php //Pjax::end(); ?></div>
