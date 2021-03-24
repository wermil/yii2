<?php

namespace frontend\modules\rbac\models\records\rbacAuthAssignment;

use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use Yii;

/**
 * Rbac Auth Assignment Validation.
 *
 * @property string $item_name
 * @property string $user_id
 * @property int|null $created_at
 *
 * @property RbacAuthItem $itemName
 */
class RbacAuthAssignmentValidation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['user_id'], 'unique'],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('rbac', 'Item Name'),
            'user_id' => Yii::t('rbac', 'User ID'),
            'created_at' => Yii::t('rbac', 'Created At'),
        ];
    }

    /**
     * Gets query for [[ItemName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'item_name']);
    }
}
