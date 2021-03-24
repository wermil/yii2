<?php

namespace frontend\modules\i18n\handlers;

use frontend\modules\i18n\models\records\i18nMessage\I18nMessage;
use frontend\modules\i18n\models\records\i18nSourceMessage\I18nSourceMessage;
use yii\i18n\MissingTranslationEvent;

/**
 * Translation Event Handler
 */
class TranslationEventHandler
{
    /**
     * Action when processing a missing translation
     *
     * @param MissingTranslationEvent $event
     */
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        $i18nSourceMessageModel = I18nSourceMessage::find()->where(['category' => $event->category, 'message' => $event->message])->one();
        if ($i18nSourceMessageModel === null) {
            $i18nSourceMessageModel = new I18nSourceMessage();
            $i18nSourceMessageModel->category = $event->category;
            $i18nSourceMessageModel->message = $event->message;
            if ($i18nSourceMessageModel->save()) {
                $i18nMessageModel = new I18nMessage();
                $i18nMessageModel->id = $i18nSourceMessageModel->id;
                $i18nMessageModel->language = 'en-US';
                $i18nMessageModel->translation = '';
                $i18nMessageModel->save();
            }
        }
        $event->translatedMessage = $event->message;
    }
}
