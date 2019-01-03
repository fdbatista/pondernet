<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form about `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    public $categoria;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_categoria'], 'integer'],
            [['nombre', 'descripcion', 'ruta_imagen', 'categoria'], 'safe'],
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
        $query = Producto::find();
        $query->joinWith(['categoria']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['categoria'] = [
            'asc' => ['categoria.nombre' => SORT_ASC],
            'desc' => ['categoria.nombre' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_categoria' => $this->id_categoria,
        ]);

        $query->andFilterWhere(['like', 'producto.nombre', $this->nombre])
            ->andFilterWhere(['like', 'producto.descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'categoria.nombre', $this->categoria]);

        return $dataProvider;
    }
}
