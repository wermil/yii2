<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column">
<?php $this->beginBody() ?>

<header class="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Sign in', 'url' => ['/user/sign-in'], 'linkOptions' => ['class' => 'btn btn-outline-secondary text-light']];
        $menuItems[] = ['label' => 'Sign up', 'url' => ['/user/sign-up'], 'linkOptions' => ['class' => 'btn btn-outline-secondary text-light']];
    } else {
        $menuItems[] = '<li class="nav-item">'
            . Html::beginForm(['/user/sign-in/sign-out'], 'post')
            . Html::submitButton(
                'Sign out (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-outline-secondary text-light nav-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>
<main class="main ">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<footer class="footer p-0 mt-auto">
    <div class="container">
        <div class="d-flex align-items-center pt-1 mt-2">
            <p class="text-muted m-0">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <?= Html::a('Contact', ['/site/contact'], ['class' => 'ml-auto btn btn-outline-secondary']) ?>
        </div>
    </div>
</footer>
<div id="particles-js"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
