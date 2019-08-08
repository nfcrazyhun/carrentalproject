<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rental".
 *
 * @property int $id
 * @property int $user_id
 * @property int $car_id
 * @property string $rent_start
 * @property string $rent_end
 * @property string $created_at
 * @property string $modified_at
 * @property string $comment
 * @property int $status
 *
 * @property Car $car
 * @property User $user
 */
class Rental extends \yii\db\ActiveRecord
{
    //define status constants
    const STATUS_ACTIVE = 1;
    const STATUS_FINISHED = 2;
    const STATUS_CANCELED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rental';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'car_id', 'status'], 'integer'],
            [['rent_start', 'rent_end', 'created_at', 'modified_at'], 'safe'],
            [['comment'], 'string'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['car_id'], 'required'],
            [['rent_start', 'rent_end'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'car_id' => 'Car ID',
            'rent_start' => 'Rent Start',
            'rent_end' => 'Rent End',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'comment' => 'Comment',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getRentalStatus(){
        $statusCode = $this->status;
        $statusText = null;

        switch ($statusCode) {
            case self::STATUS_ACTIVE:
                $statusText = 'Active';
                break;
            case self::STATUS_FINISHED:
                $statusText = 'Finished';
                break;
            case self::STATUS_CANCELED:
                $statusText = 'Canceled';
                break;
            default:
                $statusText = null;
        }

        return $statusText;
    }
}
