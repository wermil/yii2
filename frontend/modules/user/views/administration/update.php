<?php

use yii\helpers\Html;
use frontend\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\records\user\User */

$this->title = Yii::t('user', 'Update User: {name}', [
    'name' => $model->email,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('user', 'Update');
?>
<section class="content-header px-0 pb-1">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]) ?>
</section>
<section class="content bg-light border rounded">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</section>
