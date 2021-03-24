<?php

use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac}}`.
 */
class m210309_124707_create_rbac_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%rbac_auth_rule}}', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_rbac_auth_rule-name', '{{%rbac_auth_rule}}', ['name']);

        $this->createTable('{{%rbac_auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_rbac_auth_item-name', '{{%rbac_auth_item}}', ['name']);
        $this->addForeignKey(
            'fk_rbac_auth_item-rule_name_rbac_auth_rule-name',
            '{{%rbac_auth_item}}', 'rule_name',
            '{{%rbac_auth_rule}}', 'name',
            'SET NULL', 'CASCADE'
        );

        $this->createTable('{{%rbac_auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
        ]);
        $this->addPrimaryKey('pk_rbac_auth_item_child-parent-child', '{{%rbac_auth_item_child}}', ['parent', 'child']);
        $this->addForeignKey(
            'fk_rbac_auth_item_child-parent_rbac_auth_item-name',
            '{{%rbac_auth_item_child}}', 'parent',
            '{{%rbac_auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_rbac_auth_item_child-child_rbac_auth_item-name',
            '{{%rbac_auth_item_child}}', 'child',
            '{{%rbac_auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );

        $this->createTable('{{%rbac_auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_rbac_auth_assignment-user_id', '{{%rbac_auth_assignment}}', ['user_id']);
        $this->addForeignKey(
            'fk_rbac_auth_assignment-item_name_rbac_auth_item-name',
            '{{%rbac_auth_assignment}}', 'item_name',
            '{{%rbac_auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );

        $this->createIndex('idx-auth_assignment-user_id', '{{%rbac_auth_assignment}}', 'user_id');
        $this->createIndex('idx-auth_item-type', '{{%rbac_auth_item}}', 'type');


        $auth = Yii::$app->authManager;
        $roleAdmin = $auth->createRole(RbacAuthItem::ROLE_ADMIN);
        $auth->add($roleAdmin);

        $roleUser = $auth->createRole(RbacAuthItem::ROLE_USER);
        $auth->add($roleUser);

        $roleDemo = $auth->createRole(RbacAuthItem::ROLE_DEMO);
        $auth->add($roleDemo);

        $createRole = $auth->createPermission('rbac_role/create');
        $createRole->description = 'Role Create';
        $auth->add($createRole);

        $deleteRole = $auth->createPermission('rbac_role/delete');
        $deleteRole->description = 'Role Delete';
        $auth->add($deleteRole);

        $updateRole = $auth->createPermission('rbac_role/update');
        $updateRole->description = 'Role Update';
        $auth->add($updateRole);

        $updatePermission = $auth->createPermission('rbac_permission/update');
        $updatePermission->description = 'Permission Update';
        $auth->add($updatePermission);

        $view = $auth->createPermission('rbac/view');
        $view->description = 'RBAC View';
        $auth->add($view);

        $viewDashboard = $auth->createPermission('dashboard/view');
        $viewDashboard->description = 'Dashboard View';
        $auth->add($viewDashboard);

        $auth->addChild($roleAdmin, $createRole);
        $auth->addChild($roleAdmin, $deleteRole);
        $auth->addChild($roleAdmin, $updateRole);
        $auth->addChild($roleAdmin, $updatePermission);
        $auth->addChild($roleAdmin, $view);
        $auth->addChild($roleAdmin, $viewDashboard);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%rbac_auth_assignment}}');
        $this->dropTable('{{%rbac_auth_item_child}}');
        $this->dropTable('{{%rbac_auth_item}}');
        $this->dropTable('{{%rbac_auth_rule}}');
    }
}
