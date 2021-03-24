<?php

namespace frontend\modules\rbac\behaviors;

use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use frontend\modules\user\models\records\user\User;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Auth Assignment Behavior.
 */
class AuthAssignmentBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'insertingRole',
            ActiveRecord::EVENT_AFTER_DELETE => 'deletingRole',
        ];
    }

    /**
     * Assigning role to a user after creating it
     *
     * @param $event
     * @throws \Exception
     */
    public function insertingRole($event)
    {
        if ($_user = $this->isOwnerUser()) {
            $auth = Yii::$app->authManager;
            $defaultRole = $auth->getRole(RbacAuthItem::DEFAULT_ROLE);
            $auth->assign($defaultRole, $_user->id);
        }
    }

    /**
     * Deleting role to a user after deleting it
     *
     * @param $event
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deletingRole($event)
    {
        if ($_user = $this->isOwnerUser()) {
            $auth = Yii::$app->authManager;
            $auth->revokeAll($_user->id);
        }
    }

    /**
     * Checks if the owner is a User class
     *
     * @return User|false
     */
    public function isOwnerUser()
    {
        return is_object($this->owner) && get_class($this->owner) === User::class ? $this->owner : false;
    }
}
