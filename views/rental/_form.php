<?php

use app\models\Car;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rental */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rental-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    <//?= $form->field($model, 'user_id')->textInput() ?>-->
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->getId()])->label(false); ?>

<!--    <// $form->field($model, 'car_id')->textInput() ?>-->

    <?= $form->field($model, 'car_id')->label('Car')->dropDownList(ArrayHelper::map(Car::find()->all(),'id','carfullname'),['prompt'=>'Select Car']) ?>

<!--    <//?= $form->field($model, 'rent_start')->textInput() ?>-->

    <?php
    $model->rent_start = date('Y-m-d H:i:00');
    echo '<label class="control-label">Event Time Start</label>';
    echo DateTimePicker::widget([
        'model' => $model,
        'attribute' => 'rent_start',
        'name' => 'rent_start',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => date('Y-m-d H:i'),
        'options' => ['placeholder' => 'Enter start time ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00',
            'startDate' => date("Y-m-d"),
        ]
    ]);
    ?>

<!--    <//?= $form->field($model, 'rent_end')->textInput() ?>-->

    <?php
    echo '<label class="control-label">Event Time END</label>';
    echo DateTimePicker::widget([
        'model' => $model,
        'attribute' => 'rent_end',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        //'value' => date('Y-m-d H:i'),
        'options' => ['placeholder' => 'Enter end time ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00',
            'startDate' => date('Y-m-d'),
        ]
    ]);
    ?>


<!--    <//?= $form->field($model, 'created_at')->textInput() ?>-->

<!--    <//?= $form->field($model, 'modified_at')->textInput() ?>-->

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<!--    <//?= $form->field($model, 'status')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
