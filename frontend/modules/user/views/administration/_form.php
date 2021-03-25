<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\records\user\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="col-md-8 col-lg-6 col-xl-4 mx-auto">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <div class="row form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mx-auto']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
