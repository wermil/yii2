<?php

namespace frontend\modules\rbac\models\records\rbacAuthItemChild;

use frontend\modules\rbac\models\records\rbacAuthItem\RbacAuthItem;
use Yii;

/**
 * Rbac Auth Item Child Query Validation
 *
 * @property string $parent
 * @property string $child
 *
 * @property RbacAuthItem $child0
 * @property RbacAuthItem $parent0
 */
class RbacAuthItemChildValidation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_auth_item_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['child' => 'name']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['parent' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => Yii::t('rbac', 'Parent'),
            'child' => Yii::t('rbac', 'Child'),
        ];
    }

    /**
     * Gets query for [[Child0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'child']);
    }

    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'parent']);
    }
}
