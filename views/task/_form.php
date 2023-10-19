<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;

use kartik\datetime\DateTimePicker;


/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">
    <div class="container">
        <?php $form = ActiveForm::begin(['options' => ['encrypt' => 'multipart/form-data']]); ?>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'assigned_person')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'priority')->dropDownList([ 'High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low', ], ['prompt' => '']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'status')->dropDownList([ 'Complete' => 'Complete', 'Incomplete' => 'Incomplete', 'Pending' => 'Pending', ], ['prompt' => '']) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'start_time')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true]]); ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'end_time')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true]]); ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'upload')->fileInput() ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
