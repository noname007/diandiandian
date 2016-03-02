<?php

namespace app\controllers;

use app\models\IssusSearch;
use app\models\Issus;
class CpyController extends \yii\web\Controller
{
    
    public $defaultAction = 'find_rest';
    
    function actionFind_rest()
    {
        $search = new IssusSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);
        
        $dataProvider->query->andWhere(['type'=>Issus::TYPE_RESTRANT,'status'=>Issus::NORMAL]);
        return  $this->render('display',[
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    function actionAdd()
    {
            echo '添加成功';
    }
    
}
