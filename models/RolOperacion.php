<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol_operacion".
 *
 * @property integer $rol_id
 * @property integer $operacion_id
 *
 * @property Rol $rol
 * @property Operacion $operacion
 */
class RolOperacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol_operacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_id', 'operacion_id'], 'required'],
            [['rol_id', 'operacion_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rol_id' => Yii::t('app', 'Rol ID'),
            'operacion_id' => Yii::t('app', 'Operacion ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperacion()
    {
        return $this->hasOne(Operacion::className(), ['id' => 'operacion_id']);
    }
}
