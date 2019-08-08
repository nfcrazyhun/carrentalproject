<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RentalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Rentals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rental', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            //'car_id',
            [
                'attribute' => 'car_id',
                'label' => 'Car',
                'value' => 'car.carfullname',
            ],
            'rent_start',
            'rent_end',
            //'created_at',
            //'modified_at',
            //'comment:ntext',
            //'status',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => 'rentalstatus',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {cancel}',
                'buttons' => [
                    'cancel' => function ($url, $model, $key) {
                        if($model->status != \app\models\Rental::STATUS_CANCELED){
                            return Html::a ( '<span class="glyphicon glyphicon-hand-down" aria-hidden="true" title="Cancel"></span> ', ['cancel', 'id' => $model->id] );
                        }
                    },
                ],
            ],
        ],
    ]); ?>


</div>
