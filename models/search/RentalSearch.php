<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rental;

/**
 * RentalSearch represents the model behind the search form of `app\models\Rental`.
 */
class RentalSearch extends Rental
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'car_id', 'status'], 'integer'],
            [['rent_start', 'rent_end', 'created_at', 'modified_at', 'comment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Rental::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'car_id' => $this->car_id,
            'rent_start' => $this->rent_start,
            'rent_end' => $this->rent_end,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }

    public function rentalHistorySearch($userId)
    {
        $query = Rental::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $userId,
            'user_id' => $this->user_id,
            'car_id' => $this->car_id,
            'rent_start' => $this->rent_start,
            'rent_end' => $this->rent_end,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
