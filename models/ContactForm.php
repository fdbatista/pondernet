<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\controllers\SiteController;
use yii\web\YiiAsset;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body', 'verifyCode'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            // email has to be a valid email address
            ['email', 'email', 'message' => SiteController::translate('This field has an incorrect format')],
            // captcha needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => SiteController::translate('Verification code'),
            'name' => SiteController::translate('Name'),
            'email' => SiteController::translate('Email'),
            'subject' => SiteController::translate('Subject'),
            'body' => SiteController::translate('Body'),
            
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $res = Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
        return $res;
    }
    
    
    
}
