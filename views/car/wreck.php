<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List of broken cars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Car', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model, $key, $index, $column){

            if($model->status == \app\models\Car::STATUS_BROKEN){
                return ['class' => 'warning'];
            }
            if($model->status == \app\models\Car::STATUS_REMOVER){
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'brand',
            'model',
            'year',
            'odometer',
            //'reg_no',
            //'rate',
            //'created_at',
            //'modified_at',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => 'carstatus',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
