<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\RolOperacion;
use app\models\Operacion;

/**
 * This is the model class for table "rol".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property RolOperacion[] $rolOperacions
 * @property Operacion[] $operacions
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $operaciones;
    
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'unique'],
            [['nombre'], 'string', 'max' => 32],
            ['operaciones', 'safe']
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
            'operaciones' => Yii::t('app', 'Operaciones'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolOperacions()
    {
        return $this->hasMany(RolOperacion::className(), ['rol_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperacions()
    {
        return $this->hasMany(Operacion::className(), ['id' => 'operacion_id'])->viaTable('rol_operacion', ['rol_id' => 'id']);
    }
    
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'id']);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->db->createCommand()->delete('rol_operacion', 'rol_id = '.(int) $this->id)->execute();
        if ($this->operaciones)
        {
            foreach ($this->operaciones as $id)
            {
                $ro = new RolOperacion();
                $ro->rol_id = $this->id;
                $ro->operacion_id = $id;
                $ro->save();
            }
        }
    }
    
    public function getRolOperaciones()
    {
        return $this->hasMany(RolOperacion::className(), ['rol_id' => 'id']);
    }

    public function getOperacionesPermitidas()
    {
        return $this->hasMany(Operacion::className(), ['id' => 'operacion_id'])
            ->viaTable('rol_operacion', ['rol_id' => 'id'])->orderBy('nombre');
    }

    public function getOperacionesPermitidasList()
    {
        return $this->getOperacionesPermitidas()->asArray();
    }
}
