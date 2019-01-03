<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property string $id
 * @property string $nombre
 *
 * @property Provincia[] $provincias
 * @property User[] $users
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 75]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincias()
    {
        return $this->hasMany(Provincia::className(), ['id_pais' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_pais' => 'id']);
    }
}
