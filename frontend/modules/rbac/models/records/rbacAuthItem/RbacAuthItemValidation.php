<?php

namespace frontend\modules\rbac\models\records\rbacAuthItem;

use frontend\modules\rbac\models\records\rbacAuthAssignment\RbacAuthAssignment;
use frontend\modules\rbac\models\records\rbacAuthItemChild\RbacAuthItemChild;
use frontend\modules\rbac\models\records\rbacAuthRule\RbacAuthRule;
use Yii;

/**
 * Rbac Auth Item Validation.
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $rule_name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property RbacAuthAssignment[] $rbacAuthAssignments
 * @property RbacAuthRule $ruleName
 * @property RbacAuthItemChild[] $rbacAuthItemChildren
 * @property RbacAuthItemChild[] $rbacAuthItemChildren0
 * @property RbacAuthItem[] $parents
 * @property RbacAuthItem[] $children
 */
class RbacAuthItemValidation extends \yii\db\ActiveRecord
{

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_DEMO = 'demo';

    const DEFAULT_ROLE = self::ROLE_USER;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthRule::class, 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('rbac', 'Name'),
            'type' => Yii::t('rbac', 'Type'),
            'description' => Yii::t('rbac', 'Description'),
            'rule_name' => Yii::t('rbac', 'Rule Name'),
            'data' => Yii::t('rbac', 'Data'),
            'created_at' => Yii::t('rbac', 'Created At'),
            'updated_at' => Yii::t('rbac', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacAuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthAssignments()
    {
        return $this->hasMany(RbacAuthAssignment::class, ['item_name' => 'name']);
    }

    /**
     * Gets query for [[RuleName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(RbacAuthRule::class, ['name' => 'rule_name']);
    }

    /**
     * Gets query for [[RbacAuthItemChildren]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthItemChildren()
    {
        return $this->hasMany(RbacAuthItemChild::class, ['child' => 'name']);
    }

    /**
     * Gets query for [[RbacAuthItemChildren0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAuthItemChildren0()
    {
        return $this->hasMany(RbacAuthItemChild::class, ['parent' => 'name']);
    }

    /**
     * Gets query for [[Parents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(RbacAuthItem::class, ['name' => 'parent'])->viaTable('rbac_auth_item_child', ['child' => 'name']);
    }

    /**
     * Gets query for [[Children]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(RbacAuthItem::class, ['name' => 'child'])->viaTable('rbac_auth_item_child', ['parent' => 'name']);
    }
}
