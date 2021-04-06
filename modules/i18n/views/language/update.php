<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\i18n\models\records\i18nLanguage\I18nLanguage */

$this->title = Yii::t('i18n', 'Update I18n Language: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('i18n', 'I18n Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('i18n', 'Update');
?>
<div class="i18n-language-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
