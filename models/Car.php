<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Integer;
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
    //define status constants
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_BROKEN = 3;
    const STATUS_REMOVER = 4;

    private static $carNameFormat = '%s %s (%d) | Price: %d';

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
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRentals()
    {
        return $this->hasMany(Rental::className(), ['car_id' => 'id']);
    }

    /**
     * Get all car model and return it to the dropdown list as array
     * @param int $status Optional
     * @return mixed
     */
    public static function getCarDropdownList(int $status = null)
    {
        static $dropdown = [];
        if (isset($status)){
            $models = Car::find()->where(['status'=>$status])->all();
        }else {
            $models = Car::find()->all();
        }

        foreach ($models as $model) {
            $dropdown[$model->id] = sprintf(self::$carNameFormat,
                                                $model->brand,
                                                $model->model,
                                                $model->year,
                                                $model->rate);
        }
        return $dropdown;
    }

    /**
     * Translate car_ids into car names
     * eg Toyota Corolla (1985)
     * @return string
     */
    public function getCarFullName()
    {
        return sprintf(self::$carNameFormat, $this->brand, $this->model, $this->year, $this->rate);
    }


    /**
     * Get car's price
     * @return string
     */
    public function getCarPrice(){

        $format = "%d";

        return sprintf($format, $this->rate);
    }


    /**
     * Write proper status labels instead of ids
     * @return string|null
     */
    public function getCarStatus(){
        $statusCode = $this->status;
        $statusText = null;

        switch ($statusCode) {
            case self::STATUS_ACTIVE:
                $statusText = 'Active';
                break;
            case self::STATUS_INACTIVE:
                $statusText = 'Inactive';
                break;
            case self::STATUS_BROKEN:
                $statusText = 'Broken';
                break;
            case self::STATUS_REMOVER:
                $statusText = 'Removed';
                break;
            default:
                $statusText = null;
        }

        return $statusText;
    }
}
