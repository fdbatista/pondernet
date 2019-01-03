<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operacion".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $ruta
 *
 * @property RolOperacion[] $rolOperacions
 * @property Rol[] $rols
 */
class Operacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'ruta'], 'required'],
            [['nombre'], 'string', 'max' => 64],
            [['ruta'], 'string', 'max' => 128],
            [['nombre'], 'unique', 'message' => 'Ya existe una operación con ese nombre'],
            [['ruta'], 'unique', 'message' => 'Ya existe una operación con esa ruta'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'ruta' => Yii::t('app', 'Ruta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolOperacions()
    {
        return $this->hasMany(RolOperacion::className(), ['operacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Rol::className(), ['id' => 'rol_id'])->viaTable('rol_operacion', ['operacion_id' => 'id']);
    }
}
