<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Auditoria;

/**
 * AuditoriaSearch represents the model behind the search form about `app\models\Auditoria`.
 */
class AuditoriaSearch extends Auditoria
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['operacion', 'autor', 'producto', 'fecha', 'ip', 'detalles'], 'safe'],
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
        $query = Auditoria::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'operacion', $this->operacion])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'producto', $this->producto])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'detalles', $this->detalles]);

        return $dataProvider;
    }
}
