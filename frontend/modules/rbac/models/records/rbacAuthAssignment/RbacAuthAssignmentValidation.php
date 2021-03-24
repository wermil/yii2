<?php

namespace frontend\modules\rbac\models\records\rbacAuthAssignment;

use Yii;

/**
 * This is the model class for table "rbac_auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int|null $created_at
 *
// * @property RbacAuthItem $itemName
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
//            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
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

//    /**
//     * Gets query for [[ItemName]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getItemName()
//    {
//        return $this->hasOne(RbacAuthItem::className(), ['name' => 'item_name']);
//    }
}
