<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
    ],
]);
$menuItems = [];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => Yii::t('user', 'Sign in'), 'url' => ['/user/sign-in'], 'linkOptions' => ['class' => 'btn btn-outline-secondary text-light ml-auto']];
    $menuItems[] = ['label' => Yii::t('user', 'Sign up'), 'url' => ['/user/sign-up'], 'linkOptions' => ['class' => 'btn btn-outline-secondary text-light']];
    $navOptions = ['class' => 'navbar-nav ml-auto'];
} else {
    $menuItems[] = ['label' => Yii::t('site', 'Admin Panel'), 'url' => ['/dashboard/main'], 'linkOptions' => ['class' => 'btn btn-outline-secondary text-light mr-auto']];

    $menuItems[] = '<li class="ml-auto nav-item">'
        . Html::beginForm(['/user/sign-in/sign-out'], 'post')
        . Html::submitButton(
            Yii::t('user', 'Sign out') . ' (' . Yii::$app->user->identity->email . ')',
            [
                'class' => 'btn btn-outline-secondary text-light nav-link',
                'data' => [
                    'confirm' => Yii::t('user', 'Are you sure you want to sign out?'),
                    'method' => 'post',
                ],
            ]
        )
        . Html::endForm()
        . '</li>';
    $navOptions = ['class' => 'navbar-nav col-12'];
}
echo Nav::widget([
    'options' => $navOptions,
    'items' => $menuItems,
]);
NavBar::end();