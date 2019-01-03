<?php
namespace app\models;

use app\models\User;
use yii\web\BadRequestHttpException;
use yii\base\Model;
use app\controllers\SiteController;

class ActivateUserForm extends Model
{    
    private $_user;
    public $auth_key;
    
    public function rules()
    {
        return [
            ['auth_key', 'filter', 'filter' => 'trim'],
            ['auth_key', 'required', 'message' => SiteController::translate('This field is mandatory')],
            ['auth_key', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['auth_key' => $this->auth_key],
                'message' => SiteController::translate('There is no user with such access key.')
            ],
        ];
    }

    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new BadRequestHttpException(SiteController::translate('You must specify your verification token.'));
        }
        $this->auth_key = $token;
        $this->_user = User::findIdentityByAccessToken($token);
        if (!$this->_user) {
            throw new BadRequestHttpException(SiteController::translate('Incorrect verification token'));
        }
        parent::__construct($config);
    }
    
    public function attributeLabels()
    {
        return [
            'auth_key' => \app\controllers\SiteController::translate('Authorization key'),
        ];
    }
    
    public function activateAccount()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        
        return $user->save(false);
    }
}
