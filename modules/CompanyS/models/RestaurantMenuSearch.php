<?php

namespace app\modules\CompanyS\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\CompanyS\models\RestaurantMenu;

/**
 * RestaurantMenuSearch represents the model behind the search form about `app\modules\CompanyS\models\RestaurantMenu`.
 */
class RestaurantMenuSearch extends RestaurantMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_at', 'updated_at', 'restaurant_id', 'money', 'status'], 'integer'],
            [['name', 'desc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = RestaurantMenu::find();

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
            'create_at' => $this->create_at,
            'updated_at' => $this->updated_at,
            'restaurant_id' => $this->restaurant_id,
            'money' => $this->money,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
