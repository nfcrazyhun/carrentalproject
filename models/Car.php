<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property int $year
 * @property int $odometer
 * @property string $reg_no
 * @property int $rate
 * @property string $created_at
 * @property string $modified_at
 * @property int $status
 *
 * @property Rental[] $rentals
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'odometer', 'rate', 'status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['brand', 'model'], 'string', 'max' => 255],
            [['reg_no'], 'string', 'max' => 7],
            [['reg_no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'year' => 'Year',
            'odometer' => 'Odometer',
            'reg_no' => 'Reg No',
            'rate' => 'Rate',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentals()
    {
        return $this->hasMany(Rental::className(), ['car_id' => 'id']);
    }
}
