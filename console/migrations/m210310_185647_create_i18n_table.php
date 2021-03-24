<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\db\Migration;
use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;

class m210310_185647_create_i18n_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%i18n_source_message}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string()->notNull()->defaultValue(''),
            'message' => $this->text()->notNull()->defaultValue(''),
        ]);

        $this->createTable('{{%i18n_message}}', [
            'id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull()->defaultValue(''),
            'translation' => $this->text()->notNull()->defaultValue(''),
        ]);

        $this->addPrimaryKey('pk_i18n_message-id-language', '{{%i18n_message}}', ['id', 'language']);

        $this->addForeignKey(
            'fk_i18n_message-id_i18n_source_message-id',
            '{{%i18n_message}}', 'id',
            '{{%i18n_source_message}}', 'id',
            'CASCADE', 'RESTRICT'
        );
        $this->createIndex('idx_i18n_source_message-category', '{{%i18n_source_message}}', 'category');
        $this->createIndex('idx_i18n_message-language', '{{%i18n_message}}', 'language');

        $auth = Yii::$app->authManager;
        $roleAdmin = $auth->getRole(RbacAuthItem::ROLE_ADMIN);

        $createI18n = $auth->createPermission('i18n/create');
        $createI18n->description = 'Translation Create';
        $auth->add($createI18n);

        $viewI18n = $auth->createPermission('i18n/view');
        $viewI18n->description = 'Translation View';
        $auth->add($viewI18n);

        $updateI18n = $auth->createPermission('i18n/update');
        $updateI18n->description = 'Translation Update';
        $auth->add($updateI18n);

        $deleteI18n = $auth->createPermission('i18n/delete');
        $deleteI18n->description = 'Translation Delete';
        $auth->add($deleteI18n);

        $auth->addChild($roleAdmin, $createI18n);
        $auth->addChild($roleAdmin, $viewI18n);
        $auth->addChild($roleAdmin, $updateI18n);
        $auth->addChild($roleAdmin, $deleteI18n);
    }

    public function down()
    {
        $this->dropTable('{{%i18n_message}}');
        $this->dropTable('{{%i18n_source_message}}');
    }
}
