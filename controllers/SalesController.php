<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Authentication;
use app\components\AccessControl;

class SalesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                    	'actions' => ['index'],
                    	'allow' => true,
                    	'roles' => [Authentication::ROLE_GSM_ADMIN, 102, 103],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays sales dashboard
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action for sales
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm([Authentication::ROLE_GSM_ADMIN, 102, 103]);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
