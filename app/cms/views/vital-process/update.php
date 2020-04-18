<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cms\models\VitalProcess */

$this->title = 'Редактировать процесс ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vital Processes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vital-process-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>