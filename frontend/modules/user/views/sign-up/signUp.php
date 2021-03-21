<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model frontend\modules\user\models\forms\SignupForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-sign-up">
    <div class="col-lg-5 mx-auto mt-5 border rounded bg-white">
        <p class="text-center mt-3">Please fill out the following fields to sign up:</p>
        <div class="row">
            <div class="col-12">
                <?php $form = ActiveForm::begin(['id' => 'sign-up-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'nickname') ?>

                <?= $form->field($model, 'first_name') ?>

                <?= $form->field($model, 'last_name') ?>

                <div class="row form-group">
                    <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary mx-auto', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
