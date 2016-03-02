<?php

namespace app\controllers;

use Yii;
use app\models\Menu;
use app\models\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\MenuForm;
use app\models\Issus;
use yii\helpers\VarDumper;

/**
 * RestrantController implements the CRUD actions for Menu model.
 */
class RestrantController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('menucrud/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('menucrud/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuForm();
        
        if (!$model->load(Yii::$app->request->post())) 
        {
        	goto render;
        }
        $time = time();
        $model->create_at = $time;
        $model->updated_at =$time;
        $model->user_id = \Yii::$app->user->getId();
        
        $res = Issus::find()->select('id')->where(['user_id'=>$model->user_id,'type'=>0])->asArray()->one();
        $model->restaurant_id = $res['id'];
        
        if(!$model->save())
        {
        	goto  fail_process;
        }
        
        return $this->redirect(['view', 'id' => $model->id]);
        
        fail_process:
        	\Yii::error(VarDumper::dumpAsString($model->getErrors()),'MENU_CRUD_C');
        render:
        	$model->status = $model->status? : 0;
       		return $this->render('menucrud/create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!$model->load(Yii::$app->request->post())) 	
        {
        	goto end;
        }
        
        $oldtime = $model->updated_at;
		$model->updated_at = time();
			
        if(!$model->save()) 
        {
        	\Yii::error(VarDumper::dumpAsString($model->getErrors()),'MENU_CRUD_U');
        	$model->updated_at = $oldtime;
        	goto  save_failuer;
        }
        
        return $this->redirect(['view', 'id' => $model->id]);
        
        save_failuer:
        end:
            return $this->render('menucrud/update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['menucrud/index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
