<?php

use yii\db\Migration;
use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;

class m210310_145353_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'nickname' => $this->string()->null()->defaultValue(null)->unique(),
            'first_name' => $this->string()->null()->defaultValue(null),
            'last_name' => $this->string()->null()->defaultValue(null),
            'auth_key' => $this->string(32)->notNull(),
            'verification_token' => $this->string()->null()->defaultValue(null),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->null()->defaultValue(null)->unique(),
            'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue(9),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $auth = Yii::$app->authManager;
        $roleAdmin = $auth->createRole(RbacAuthItem::ROLE_ADMIN);
        $auth->add($roleAdmin);

        $roleUser = $auth->createRole(RbacAuthItem::ROLE_USER);
        $auth->add($roleUser);

        $roleDemo = $auth->createRole(RbacAuthItem::ROLE_DEMO);
        $auth->add($roleDemo);


        $createPost = $auth->createPermission('user/create');
        $createPost->description = 'User Create';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('user/update');
        $updatePost->description = 'User Update';
        $auth->add($updatePost);

        $deletePost = $auth->createPermission('user/delete');
        $deletePost->description = 'User Delete';
        $auth->add($deletePost);

        $viewPost = $auth->createPermission('user/view');
        $viewPost->description = 'User View';
        $auth->add($viewPost);

        $auth->addChild($roleAdmin, $createPost);
        $auth->addChild($roleAdmin, $updatePost);
        $auth->addChild($roleAdmin, $deletePost);
        $auth->addChild($roleAdmin, $viewPost);



    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
