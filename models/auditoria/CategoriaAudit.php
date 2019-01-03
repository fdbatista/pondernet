<?php

namespace app\models\auditoria;

class CategoriaAudit extends \yii\base\Model
{
    public $id, $padre, $nombre;
    public function __construct($model, $config = array())
    {
        parent::__construct($config);
        $this->id = $model->id;
        if ($model->id_padre)
            $this->padre = \app\models\Categoria::findOne(['id' => $model->id_padre])->nombre;
        $this->nombre = $model->nombre;
    }
}
