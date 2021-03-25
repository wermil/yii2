<?php

use frontend\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\records\user\User */

$this->title = 'User: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="content-header px-0 pb-1">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]) ?>
</section>
<section class="content bg-light border rounded">
    <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
        <div class="table-responsive">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'email:email',
                    'nickname',
                    'first_name',
                    'last_name',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>
        </div>
        <div class="row">
            <?php if (Yii::$app->user->can('user/delete')) : ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger mx-auto',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
            <?php if (Yii::$app->user->can('user/update')) : ?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary mx-auto']) ?>
            <?php endif; ?>
        </div>
    </div>
</section>
