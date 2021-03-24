<?php

return [
    'name' => 'Yii App',
    'language' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
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
            'viewPath' => '@common/mail',
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
                    'on missingTranslation' => [frontend\modules\i18n\handlers\TranslationEventHandler::class, 'handleMissingTranslation']
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
    ],
];
