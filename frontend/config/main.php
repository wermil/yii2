<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'P_mpw4mfp9JBAhC9cAPx1nsv4yawcBNO',
        ],
        'user' => [
            'identityClass' => frontend\modules\user\models\records\user\UserIdentity::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['/user/sign-in'],
        ],
        'session' => [
            'class' => yii\redis\Session::class,
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => frontend\modules\user\UserModule::class,
        ],
        'i18n' => [
            'class' => frontend\modules\i18n\I18nModule::class,
        ],
        'rbac' => [
            'class' => frontend\modules\rbac\RbacModule::class,
        ],
        'dashboard' => [
            'class' => frontend\modules\dashboard\DashboardModule::class,
        ],
    ],
    'params' => $params,
];
