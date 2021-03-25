<?php

use frontend\widgets\Breadcrumbs;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\search\UserAdministrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header px-0 pb-1">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]) ?>
</section>
<section class="content bg-light border rounded">
    <div class="user-index">
        <?php if (Yii::$app->user->can('user/create')) : ?>
            <p>
                <?= Html::a(Yii::t('user', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        <?php endif; ?>
        <div class="table-responsive">
            <?= GridView::widget([
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered table-hover'
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'email:email',
                    'nickname',
                    'first_name',
                    'last_name',
                    'status',
                    'created_at',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('', $url, ['class' => 'fas fa-eye fa-lg text-info px-1']);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('', $url, ['class' => 'fas fa-pencil-alt fa-lg text-warning px-1']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('', $url, ['class' => 'fas fa-trash fa-lg text-danger px-1', 'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ]]);
                            },
                        ],
                        'visibleButtons' => [
                            'view' => Yii::$app->user->can('user/view'),
                            'update' => Yii::$app->user->can('user/update'),
                            'delete' => Yii::$app->user->can('user/delete'),
                        ]
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <div class="text-danger"></div>
</section>