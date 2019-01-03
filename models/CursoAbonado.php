<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso_abonado".
 *
 * @property integer $id_usuario
 * @property string $id_producto
 * @property integer $comision
 * @property integer $referido_por
 * @property integer $bono_cobrado
 * 
 * @property \app\models\User $userId
 * @property \app\models\Producto $productoId
 */
class CursoAbonado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curso_abonado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_producto'], 'required'],
            [['id_usuario', 'id_producto', 'comision'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => Yii::t('app', 'User ID'),
            'id_producto' => Yii::t('app', 'Producto ID'),
            'comision' => Yii::t('app', 'Comision'),
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }
    
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'id_producto']);
    }
}
