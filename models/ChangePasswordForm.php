<?php

namespace app\models;

use yii\base\Model;
use app\controllers\SiteController;

class ChangePasswordForm extends Model
{
    public $old_password, $new_password, $confirmation;
    
    public function rules()
    {
        return [
            [['old_password', 'new_password', 'confirmation'], 'filter', 'filter' => 'trim'],
            [['old_password', 'new_password', 'confirmation'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['confirmation', 'compare', 'compareAttribute' => 'new_password', 'operator' => '==', 'skipOnEmpty' => false],
            [['new_password', 'confirmation'], 'string', 'min' => 6, 'max' => 50],
            [['new_password', 'confirmation'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'old_password' => SiteController::translate('Current password'),
            'new_password' => SiteController::translate('New password'),
            'confirmation' => SiteController::translate('Confirm new password'),
        ];
    }
}
