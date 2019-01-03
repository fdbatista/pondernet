<?php

namespace app\models\auditoria;

use Yii;

class OperacionAudit extends \yii\base\Model
{
    public $id, $nombre, $ruta;
    
    public function __construct($model, $config = array())
    {
        parent::__construct($config);
        $this->id = $model->id;
        $this->nombre = $model->nombre;
        $this->ruta = $model->ruta;
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'ruta' => Yii::t('app', 'Ruta'),
        ];
    }
}
