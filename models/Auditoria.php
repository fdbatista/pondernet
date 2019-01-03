<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auditoria".
 *
 * @property string $id
 * @property string $operacion
 * @property string $autor
 * @property string $producto
 * @property string $fecha
 * @property string $ip
 * @property string $detalles
 */
class Auditoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auditoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autor', 'ip'], 'required'],
            [['fecha'], 'safe'],
            [['operacion'], 'string', 'max' => 250],
            [['autor'], 'string', 'max' => 50],
            [['producto'], 'string', 'max' => 250],
            [['ip'], 'string', 'max' => 25],
            [['detalles'], 'string', 'max' => 65535]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'operacion' => Yii::t('app', 'Acción ejecutada'),
            'autor' => Yii::t('app', 'Autor'),
            'producto' => Yii::t('app', 'Curso'),
            'fecha' => Yii::t('app', 'Fecha'),
            'ip' => Yii::t('app', 'IP'),
            'detalles' => Yii::t('app', 'Detalles'),
        ];
    }
}
