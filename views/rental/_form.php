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

    <?php $form = ActiveForm::begin(
            ['enableAjaxValidation' => true,]
    ); ?>

<!--    <//?= $form->field($model, 'user_id')->textInput() ?>-->
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->getId()])->label(false); ?>

<!--    <// $form->field($model, 'car_id')->textInput() ?>-->

    <!--<//?= $form->field($model, 'car_id')->label('Car')->dropDownList(ArrayHelper::map(Car::find()->all(),'id','carfullname'),['prompt'=>'Select a Car']) ?>-->


    <?= $form->field($model, 'car_id')->label('Car')->dropDownList(Car::getCarDropdownList(), ['prompt'=>'Select a Car']) ?>






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
    <label class="control-label" for="sum_day">Number of Days</label><br>
        <input id="sum_day" value="" disabled>

    <br><label class="control-label" for="total">Total Price: </label><br><input type="text" name="total" id="total" size="6" value="0" onfocus="blur();" disabled>

    <!--    <//?= $form->field($model, 'created_at')->textInput() ?>-->

<!--    <//?= $form->field($model, 'modified_at')->textInput() ?>-->

    <?= $form->field($model, 'comment')->textarea(['rows' => 6, 'class' => 'ckeditor']) ?>




<!--    <//?= $form->field($model, 'status')->textInput() ?>-->

    <div class="potential-price">

        <ul>
            <li>Base price: <input disabled type="text" name="baseprice" value="<?= \app\models\Rental::RENTAL_BASE_PRICE; ?>"></li>
            <li>Car's cost per day: <input disabled type="text" name="costperday" >
            <li>Number of days: <input disabled type="text" name="numberofdays" ></li>
            <li>Car rental cost in period: <input disabled type="text" name="costinoeriod" ></li>
            <li>Sum of costs: <input disabled type="text" name="sumofcosts" ></li>
        </ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="../js/ckeditor/ckeditor.js"></script>




<script type="text/javascript">
    function calcForm(form,submit_it) {
// By making the first element 0, this associates the list precisely with the select list.
// To maintain all you need to do is change this array.
        var prices = [
'0','0'
<?php foreach (ArrayHelper::map(Car::find()->all(),'id','carprice') as $price) { ?>
, '<?= $price ?>'
<?php

            }
?>
        ];
        var sel = document.getElementById('rental-car_id'); // The list
        var ind = sel.selectedIndex; // What's selected
        var total = document.getElementById('total');
        total.value = prices[sel[ind].value]; // the correlating value from the array
        if (ind == 0) { return; }
        if (submit_it) { form.submit(); }
    }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

    // A $( document ).ready() block.
    $( document ).ready(function() {
        console.log( "ready!" );
        //alert("Hello! I am an alert box!!");

        $("#rental-car_id").change(function () {
            let $selected = $(this).val();   //get selected car id
            console.log("Selected car id: "+$selected);
        )
    });

</script>