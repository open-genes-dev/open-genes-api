<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model cms\models\GeneLongevityAssociationType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gene-longevity-association-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
