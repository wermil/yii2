<?php

namespace frontend\modules\rbac\behaviors;

use frontend\modules\rbac\models\records\rbacAuthAssignment\RbacAuthAssignment;
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
            ActiveRecord::EVENT_BEFORE_INSERT => 'insertingRole',
//            ActiveRecord::EVENT_AFTER_UPDATE => 'updatingRole',
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
        if ($this->isUserOwner()) {
            $rbacAuthAssignment = new RbacAuthAssignment();
            $rbacAuthAssignment->item_name = $this->owner::ROLE_USER;
            $rbacAuthAssignment->user_id = (string)$this->owner->id;
            $rbacAuthAssignment->created_at = time();
            $rbacAuthAssignment->save();
        }
    }

//    /**
//     * Updating role to a user after updating it
//     *
//     * @param $event
//     */
//    public function updatingRole($event)
//    {
//        if ($this->isUserOwner()) {
//            $rbacAuthAssignment = RbacAuthAssignment::find()->where(['user_id' => (string)$this->owner->id])->one();
//            $rbacAuthAssignment->item_name = $this->owner->role;
//            $rbacAuthAssignment->created_at = time();
//            $rbacAuthAssignment->save();
//        }
//    }

    /**
     * Deleting role to a user after deleting it
     *
     * @param $event
     */
    public function deletingRole($event)
    {
        if ($this->isUserOwner()) {
            $rbacAuthAssignment = RbacAuthAssignment::find()->where(['user_id' => (string)$this->owner->id])->one();
            $rbacAuthAssignment->delete();
        }
    }

    /**
     * Checks if the owner is a User class
     */
    public function isUserOwner()
    {
        return is_object($this->owner) && get_class($this->owner) === User::class;
    }
}
