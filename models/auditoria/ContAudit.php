<?php

namespace app\models\auditoria;

use Yii;
use yii\base\Model;

class ContAudit extends Model
{
    public $operacion, $autor, $producto, $ip, $model;
    
    public function __construct($operacion, $producto, $model, $config = array())
    {
        parent::__construct($config);
        $this->operacion = $operacion;
        $this->producto = $producto;
        $this->ip = Yii::$app->request->getUserIP();
        $this->autor = Yii::$app->user->identity->username . ' (' . Yii::$app->user->identity->email . ')';
        $this->model = $model;
    }
}
