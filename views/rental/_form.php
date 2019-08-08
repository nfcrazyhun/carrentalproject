<?php

use app\models\Car;
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

    <?= $form->field($model, 'car_id',)->label('Car')->dropDownList(ArrayHelper::map(Car::find()->all(),'id','carfullname'),['prompt'=>'Select Car']) ?>

    <?= $form->field($model, 'rent_start')->textInput() ?>

    <?= $form->field($model, 'rent_end')->textInput() ?>

<!--    <//?= $form->field($model, 'created_at')->textInput() ?>-->

<!--    <//?= $form->field($model, 'modified_at')->textInput() ?>-->

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<!--    <//?= $form->field($model, 'status')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
