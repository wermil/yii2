<?php

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name' => 'Yii App',
    'language' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'id' => 'yii-app',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\controllers',
    'viewPath'=>'@app/views',
    'components' => [
        'redis' => [
            'class' => yii\redis\Connection::class,
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'cache' => [
            'class' => yii\redis\Cache::class,
        ],
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=localdb',
            'username' => 'localuser',
            'password' => 'localpass',
            'charset' => 'utf8',
            //'enableSchemaCache' => true,
            //'schemaCacheDuration' => 60,
            //'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            'viewPath' => '@app/layouts/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => \yii\i18n\DbMessageSource::class,
                    'sourceMessageTable' => '{{%i18n_source_message}}',
                    'messageTable' => '{{%i18n_message}}',
                    'enableCaching' => false,
                    'cachingDuration' => 0,
                    'forceTranslation' => true,
                    'sourceLanguage' => 'en_US',
                    'on missingTranslation' => [app\modules\i18n\handlers\TranslationEventHandler::class, 'handleMissingTranslation']
                ],
            ],
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
            'itemTable' => 'rbac_auth_item',
            'itemChildTable' => 'rbac_auth_item_child',
            'assignmentTable' => 'rbac_auth_assignment',
            'ruleTable' => 'rbac_auth_rule',
        ],
        'request' => [
            'csrfParam' => '_csrf-app',
            'cookieValidationKey' => 'P_mpw4mfp9JBAhC9cAPx1nsv4yawcBNO',
        ],
        'user' => [
            'identityClass' => app\modules\user\models\records\user\UserIdentity::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-app', 'httpOnly' => true],
            'loginUrl' => ['/user/sign-in'],
        ],
        'session' => [
            'class' => yii\redis\Session::class,
            'name' => 'advanced-app',
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
            'class' => app\modules\user\UserModule::class,
        ],
        'i18n' => [
            'class' => app\modules\i18n\I18nModule::class,
        ],
        'rbac' => [
            'class' => app\modules\rbac\RbacModule::class,
        ],
        'dashboard' => [
            'class' => app\modules\dashboard\DashboardModule::class,
        ],
    ],
    'params' => $params,
];
