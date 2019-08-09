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

    <?= $form->field($model, 'car_id')->label('Car')->dropDownList(ArrayHelper::map(Car::find()->all(),'id','carfullname'),['prompt'=>'Select a Car']) ?>

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

    <?= $form->field($model, 'comment')->textarea(['rows' => 6, 'class' => 'ckeditor']) ?>




<!--    <//?= $form->field($model, 'status')->textInput() ?>-->

    <div class="potential-price">

        <ul>
            <li>Base price: <?= \app\models\Rental::RENTAL_BASE_PRICE; ?></li>
            <li>Car cost per day: <?php  //ajax call echo actionCarcostperday($model->car_id); ?></li>
            <li>Car rental cost in period: <?php //ajax call echo $model->car_id; ?></li>
            <li>Sum: <?php //ajax call echo Car::calcCarSumCost(); ?></li>
        </ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="../js/ckeditor/ckeditor.js"></script>

<form method="post" action="You_will_still_need_recalculation_server_side.cgi" name="calc" id="calc" onSubmit="return false;">
    <p>Select the number of participants and continue.</p>
    <select name="num" id="num" onChange="calcForm(this.form);">
        <option value="0">Please Select</option>
        <option value="1">1 - 140.40 euros</option>
        <option value="2">2 - 206.40 euros</option>
        <option value="3">3 - 272.40 euros</option>
        <option value="4">4 - 338.40 euros</option>
    </select>
    Total: <strong>$</strong> <input type="text" name="total" id="total" size="6" value="0.00" onfocus="blur();">
    <input type="submit" name="submitButton" id="submitButton" onClick="calcForm(this.form,1);" value="Continue &gt;&gt;">
</form>

<script type="text/javascript">
    function calcForm(form,submit_it) {
// By making the first element 0, this associates the list precisely with the select list.
// To maintain all you need to do is change this array.
        var prices = [
            '0.00',
            '140.40',
            '206.40',
            '272.40',
            '338.40'];
        var sel = document.getElementById('num'); // The list
        var ind = sel.selectedIndex; // What's selected
        var total = document.getElementById('total');
        total.value = prices[sel[ind].value]; // the correlating value from the array
        if (ind == 0) { return; }
        if (submit_it) { form.submit(); }
    }
</script>


