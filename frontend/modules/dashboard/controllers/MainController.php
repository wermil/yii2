<?php

namespace frontend\modules\dashboard\controllers;

use frontend\layouts\controller\LayoutController;
use yii\filters\AccessControl;

/**
 * Main Dashboard Controller
 */
class MainController extends LayoutController
{
    /**
     * {@inheritdoc}
     */
    public $layout = self::LAYOUT_ADMIN_PANEL;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'permissions' => ['dashboard/view'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Dashboard
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
