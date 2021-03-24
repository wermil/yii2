<?php

namespace frontend\modules\rbac\behaviors;

use frontend\modules\rbac\models\records\rbacAuthAssignment\RbacAuthAssignment;
use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use frontend\modules\user\models\records\user\User;
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
     */
    public function insertingRole($event)
    {
        if ($_user = $this->isOwnerUser()) {
            $rbacAuthAssignment = new RbacAuthAssignment();
            $rbacAuthAssignment->item_name = RbacAuthItem::DEFAULT_ROLE;
            $rbacAuthAssignment->user_id = (string)$_user->id;
            $rbacAuthAssignment->created_at = time();
            $rbacAuthAssignment->save();
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
            $rbacAuthAssignment = RbacAuthAssignment::find()->where(['user_id' => (string)$_user->id])->one();
            if ($rbacAuthAssignment !== null) {
                $rbacAuthAssignment->delete();
            }

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
