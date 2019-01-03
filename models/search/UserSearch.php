<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'rol_id', 'id_tipo_doc_id', 'tel_movil', 'tel_fijo', 'munic', 'prov', 'id_pais', 'referido_por', 'id_nivel_acceso', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'nombre', 'apellidos', 'num_doc_id', 'skype', 'paypal', 'facebook', 'linkedin', 'twitter', 'youtube', 'direccion', 'codigo_postal'], 'safe'],
            [['term_condic'], 'boolean'],
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
        $query = User::find();

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
            'status' => $this->status,
            'rol_id' => $this->rol_id,
            'id_tipo_doc_id' => $this->id_tipo_doc_id,
            'tel_movil' => $this->tel_movil,
            'tel_fijo' => $this->tel_fijo,
            'munic' => $this->munic,
            'prov' => $this->prov,
            'id_pais' => $this->id_pais,
            'referido_por' => $this->referido_por,
            'term_condic' => $this->term_condic,
            'id_nivel_acceso' => $this->id_nivel_acceso,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'num_doc_id', $this->num_doc_id])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'paypal', $this->paypal])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'youtube', $this->youtube])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'codigo_postal', $this->codigo_postal]);

        return $dataProvider;
    }
}
