<?php

namespace frontend\modules\i18n\models\records\i18nMessage;

use frontend\modules\i18n\models\records\i18nSourceMessage\I18nSourceMessage;
use Yii;

/**
 * This is the model class for table "i18n_message".
 *
 * @property int $id
 * @property string $language
 * @property string $translation
 *
 * @property I18nSourceMessage $id0
 */
class I18nMessageValidation extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language' => Yii::t('i18n', 'Language'),
            'translation' => Yii::t('i18n', 'Translation'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => I18nSourceMessage::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%i18n_message}}';
    }


    /**
     * Connection [[I18nSourceMessage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(I18nSourceMessage::class, ['id' => 'id']);
    }
}
