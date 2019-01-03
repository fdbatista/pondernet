<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagos;

/**
 * PagosSearch represents the model behind the search form about `app\models\Pagos`.
 */
class PagosSearch extends Pagos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'tipo', 'pagado_por'], 'integer'],
            [['cantidad'], 'number'],
            [['pagado'], 'boolean'],
            [['fecha_solic', 'fecha_pagado'], 'safe'],
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
        $query = Pagos::find();

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
            'id_usuario' => $this->id_usuario,
            'cantidad' => $this->cantidad,
            'tipo' => $this->tipo,
            'pagado' => $this->pagado,
            'pagado_por' => $this->pagado_por,
            'fecha_solic' => $this->fecha_solic,
            'fecha_pagado' => $this->fecha_pagado,
        ]);

        return $dataProvider;
    }
}
