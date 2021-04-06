<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\i18n\models\records\i18nMessage\I18nMessage */

$this->title = Yii::t('i18n', 'Create I18n Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('i18n', 'I18n Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
