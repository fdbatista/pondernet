<?php

namespace app\models;

use Yii;
use app\controllers\SiteController;

/**
 * This is the model class for table "pagos".
 *
 * @property string $id
 * @property integer $id_usuario
 * @property double $cantidad
 * @property integer $tipo
 * @property boolean $pagado
 * @property integer $pagado_por
 * @property string $fecha_solic
 * @property string $fecha_pagado
 *
 * @property User $idUsuario
 * @property User $pagadoPor
 */
class Pagos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'tipo'], 'required'],
            [['id_usuario', 'tipo', 'pagado_por'], 'integer'],
            [['cantidad'], 'number'],
            [['pagado'], 'boolean'],
            [['fecha_solic', 'fecha_pagado'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => SiteController::translate('User'),
            'cantidad' => SiteController::translate('Credit'),
            'tipo' => SiteController::translate('Type'),
            'pagado' => SiteController::translate('Payed'),
            'pagado_por' => SiteController::translate('Payed by'),
            'fecha_solic' => SiteController::translate('Request date'),
            'fecha_pagado' => SiteController::translate('Payment date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagadoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'pagado_por']);
    }
}
