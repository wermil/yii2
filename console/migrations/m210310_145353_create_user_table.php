<?php

use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use yii\db\Migration;

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

        $this->batchInsert('{{%user}}',
            ['email', 'nickname', 'first_name', 'last_name', 'auth_key', 'password_hash', 'status', 'created_at', 'updated_at'],
            [
                ['admin@root.yii', 'admin', 'root', 'yii', 'szcZvk1Ue4VuqQEM_iKks6MTGa4VDwUt', '$2y$13$/J6sm.kelwbAF00naid60.KzlJoZ/xrRtZD2gQPWwOFC.DyGOQwHS', 10, 1616608802, 1616608802],
                ['demo@root.yii', 'demo', 'root', 'yii', 'U3H364WvKgRNaPwppmEswpmy7gRX3kRJ', '$2y$13$dkV4gUj/NLPXwOQmn/ghjOti65QiwasENGrWao0DIYK8DXc/.svIK', 10, 1616608986, 1616608986],
                ['user@user.yii', 'user', 'user', 'yii', 'M2zygXWjY83gTr-2Tq6svp1RBcOEwFRY', '$2y$13$F/or7xW4aZzbcDZiz34D8.iSRUzkyUa8exBu.RveWNONchCLrEuve', 10, 1616609038, 1616609038],
            ]
        );

        $auth = Yii::$app->authManager;
        $roleAdmin = $auth->getRole(RbacAuthItem::ROLE_ADMIN);
        $roleDemo = $auth->getRole(RbacAuthItem::ROLE_DEMO);
        $roleUser = $auth->getRole(RbacAuthItem::ROLE_USER);
        $auth->assign($roleAdmin, 1);
        $auth->assign($roleDemo, 2);
        $auth->assign($roleUser, 3);





        $create = $auth->createPermission('user/create');
        $create->description = 'User Create';

        $view = $auth->createPermission('user/view');
        $view->description = 'User View';

        $update = $auth->createPermission('user/update');
        $update->description = 'User Update';

        $delete = $auth->createPermission('user/delete');
        $delete->description = 'User Delete';

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
        $this->dropTable('{{%user}}');

        $auth = Yii::$app->authManager;
        $create = $auth->getPermission('user/create');
        $update = $auth->getPermission('user/update');
        $delete = $auth->getPermission('user/delete');
        $view = $auth->getPermission('user/view');
        $auth->remove($create);
        $auth->remove($update);
        $auth->remove($delete);
        $auth->remove($view);
        $auth->revokeAll(1);
        $auth->revokeAll(2);
        $auth->revokeAll(3);

    }
}
