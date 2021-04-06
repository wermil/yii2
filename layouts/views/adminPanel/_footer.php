<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<footer class="main-footer p-1">
    <div class="col-12">
        <div class="d-flex align-items-center">
            <p class="text-muted m-0">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <div class="ml-auto pr-5 mr-5">
                <?= Html::a('RU', Url::to('/i18n/language/set'), ['class' => 'px-2 mx-1', 'data-method' => 'POST',
                    'data-params' => [
                        'identifier' => 'ru-RU',
                        'url' => Url::current()
                    ]]) ?>
                <?= Html::a('EN', Url::to('/i18n/language/set'), ['class' => 'px-2 mx-1', 'data-method' => 'POST',
                    'data-params' => [
                        'identifier' => 'en-US',
                        'url' => Url::current()
                    ],]) ?>
            </div>
        </div>
    </div>
</footer>
