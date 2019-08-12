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

    <!--<//?= $form->field($model, 'car_id')->label('Car')->dropDownList(ArrayHelper::map(Car::find()->all(),'id','carfullname'),['prompt'=>'Select a Car']) ?>-->


    <?= $form->field($model, 'car_id')->label('Car')->dropDownList(Car::getCarDropdownList(Car::STATUS_ACTIVE), ['prompt'=>'Select a Car']) ?>






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
            <li>Base price: <input disabled type="text" id="baseprice"></li>
            <li>Car's cost per day: <input disabled type="text" id="costperday" >
            <li>Number of days: <input disabled type="text" id="numberofdays" ></li>
            <li>Car rental cost in period: <input disabled type="text" id="costinoeriod" ></li>
            <li>Sum of costs: <input disabled type="text" id="sumofcosts" ></li>
        </ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="../js/ckeditor/ckeditor.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

    // A $( document ).ready() block.
    $(document).ready(function() {
        console.log( "ready!" );
        let $selected = null;
        let $sdate = null;
        let $edate = null;

        $("#rental-car_id, #rental-rent_start, #rental-rent_end").change(function () {
            $selected = $("#rental-car_id").val();  //get selected car id
            $sdate = $("#rental-rent_start").val(); //get start date
            $edate = $("#rental-rent_end").val();   //get end date
            console.log("Selected car id: " + $selected);


            $.get("/rental/ajaxcarprice", {id:$selected, sdate:$sdate, edate:$edate}, function ($data) {
                //display values which is returned from the action method
                console.log("and its value: "+$data);
                $data = jQuery.parseJSON($data);

                $("#baseprice").val($data.basePrice);
                $("#costperday").val($data.rate);
                $("#numberofdays").val($data.numberOfDays);
                $("#costinoeriod").val($data.costInPeriod);
                $("#sumofcosts").val($data.sumOfCosts);

            });

        });

    });

</script>