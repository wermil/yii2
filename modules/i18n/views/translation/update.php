<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\i18n\models\records\i18nMessage\I18nMessage */

$this->title = Yii::t('i18n', 'Update I18n Message: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('i18n', 'I18n Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('i18n', 'Update');
?>
<div class="i18n-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
