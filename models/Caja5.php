<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caja_5".
 *
 * @property integer $id_usuario
 * @property boolean $notificado
 */
class Caja5 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'caja_5';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['notificado'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'notificado' => Yii::t('app', 'Notificado'),
        ];
    }
}
