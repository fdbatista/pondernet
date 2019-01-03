<?php

namespace app\models\auditoria;

use Yii;

class RolAudit extends \yii\base\Model
{
    public $id, $nombre, $Operaciones;
    
    public function __construct($model, $copiarOperaciones = true, $config = array())
    {
        parent::__construct($config);
        $this->id = $model->id;
        $this->nombre = $model->nombre;
        $this->Operaciones = [];
        if ($copiarOperaciones)
        {
            foreach ($model->operaciones as $operacion)
                $this->Operaciones[] = \app\models\Operacion::findOne(['id' => $operacion])->nombre;
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'operaciones' => Yii::t('app', 'Operaciones'),
        ];
    }
}
