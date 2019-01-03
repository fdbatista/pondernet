<?php

namespace app\models;

use app\controllers\SiteController;

class Invitacion extends \yii\base\Model
{
    public $destinatario, $tipo_invitacion, $id_curso;
    
    public function rules()
    {
        return
        [
            [['destinatario', 'tipo_invitacion'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            ['destinatario', 'email', 'message' => SiteController::translate('This field has an incorrect format')],
            ['id_curso', 'validateCurso', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'destinatario' => SiteController::translate('Email'),
            'tipo_invitacion' => SiteController::translate('Invitation type'),
            'id_curso' => SiteController::translate('Course'),
        ];
    }
    
    public function validateCurso($attribute, $params)
    {
        if ($this->tipo_invitacion == 1 && (!isset($this->$attribute) || $this->$attribute == ""))
            $this->addError($attribute, SiteController::translate('You must select a course'));
    }
    
}
