<?php

namespace app\controllers\user;


use dektrium\user\controllers\AdminController as BaseAdmin;
use app\models\IssusUser;

use Yii;

class AdminController extends BaseAdmin
{

        /**
         * 
         * {@inheritDoc}
         * @see \dektrium\user\controllers\AdminController::actionCreate()
         */
        public function actionCreate()
        {
            /** @var IssusUser $user */
            $user = Yii::createObject([
                'class'    => IssusUser::className(),
                'scenario' => 'create',
            ]);
        
            $this->performAjaxValidation($user);
        
            if ($user->load(Yii::$app->request->post()) && $user->create()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('user', 'User has been created'));
        
                return $this->redirect(['update', 'id' => $user->id]);
            }
        
            return $this->render('create', [
                'user' => $user,
            ]);
        }
}