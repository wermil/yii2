<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\i18n\models\records\i18nLanguage\I18nLanguage */

$this->title = Yii::t('i18n', 'Create I18n Language');
$this->params['breadcrumbs'][] = ['label' => Yii::t('i18n', 'I18n Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-language-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
