<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use yii\db\Migration;

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

        $create = $auth->createPermission('i18n/create');
        $create->description = 'Translation Create';

        $view = $auth->createPermission('i18n/view');
        $view->description = 'Translation View';

        $update = $auth->createPermission('i18n/update');
        $update->description = 'Translation Update';

        $delete = $auth->createPermission('i18n/delete');
        $delete->description = 'Translation Delete';

        $auth->add($create);
        $auth->add($view);
        $auth->add($update);
        $auth->add($delete);

        $auth->addChild($roleAdmin, $create);
        $auth->addChild($roleAdmin, $view);
        $auth->addChild($roleAdmin, $update);
        $auth->addChild($roleAdmin, $delete);
    }

    public function down()
    {
        $this->dropTable('{{%i18n_message}}');
        $this->dropTable('{{%i18n_source_message}}');

        $auth = Yii::$app->authManager;
        $create = $auth->getPermission('i18n/create');
        $view = $auth->getPermission('i18n/view');
        $update = $auth->getPermission('i18n/update');
        $delete = $auth->getPermission('i18n/delete');
        $auth->remove($create);
        $auth->remove($view);
        $auth->remove($update);
        $auth->remove($delete);
    }
}
