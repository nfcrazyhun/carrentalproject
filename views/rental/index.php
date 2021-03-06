<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RentalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rentals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rental', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'label' => 'Username',
                'value' => 'user.username',
            ],
            [
                'attribute' => 'car_id',
                'label' => 'Car',
                'value' => 'car.carfullname',
            ],
            'rent_start',
            'rent_end',
            'created_at',
            'modified_at',
            'comment:ntext',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => 'rentalstatus',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
