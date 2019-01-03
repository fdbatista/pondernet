<?php

namespace app\models\auditoria;

use app\models\Categoria;

class ProductoAudit extends \yii\base\Model
{
    public $id, $nombre, $categoria, $recurso;
    
    public function __construct($model, $nombreRecurso = null, $config = array())
    {
        parent::__construct($config);
        $this->id = $model->id;
        $this->nombre = $model->nombre;
        if ($nombreRecurso)
            $this->recurso = $nombreRecurso;
        $this->categoria = Categoria::findOne($model->id_categoria)->nombre;
    }
}
