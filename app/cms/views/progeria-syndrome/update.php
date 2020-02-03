<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cms\models\ProgeriaSyndrome */

$this->title = 'Update Progeria Syndrome: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Progeria Syndromes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="progeria-syndrome-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
