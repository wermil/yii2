<?php

namespace frontend\modules\i18n\models\records\i18nSourceMessage;

use frontend\modules\i18n\models\records\i18nMessage\I18nMessage;
use Yii;

/**
 * This is the model class for table "i18n_source_message".
 *
 * @property int $id
 * @property string $category
 * @property string $message
 *
 * @property I18nMessage[] $i18nMessages
 */
class I18nSourceMessageValidation extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('i18n', 'ID'),
            'category' => Yii::t('i18n', 'Category'),
            'message' => Yii::t('i18n', 'Message'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'message'], 'required'],
            [['message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%i18n_source_message}}';
    }

    /**
     * Connection [[I18nMessage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getI18nMessages()
    {
        return $this->hasMany(I18nMessage::class, ['id' => 'id']);
    }
}
