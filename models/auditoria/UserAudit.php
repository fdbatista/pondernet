<?php

namespace app\models\auditoria;

use yii\helpers\ArrayHelper;

class UserAudit extends \yii\base\Model
{
    public $id, $usuario, $nombre, $IDENTIDAD, $CAMBIOS;
    
    public function __construct($model, $beforeUpdate = array(), $config = array())
    {
        parent::__construct($config);
        $this->id = $model->id;
        $this->usuario = $model->username;
        $this->nombre = $model->nombre . ' ' . $model->apellidos;
        $this->IDENTIDAD = [\app\models\TipoDocId::findOne($model->id_tipo_doc_id)->nombre => $model->num_doc_id];
        $this->CAMBIOS = [];
        
        if ($beforeUpdate)
        {
            foreach ($model->attributes as $key => $value)
            {
                if (!in_array($key, ['created_at', 'updated_at']) && ArrayHelper::keyExists($key, $beforeUpdate))
                {
                    $oldValue = $beforeUpdate[$key];
                    if ($oldValue != $value)
                    {
                        $this->CAMBIOS[$key] = $value;
                    }
                }
            }
        }
    }
    
}
