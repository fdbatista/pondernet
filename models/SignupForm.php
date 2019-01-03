<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\controllers\SiteController;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username, $email;
    public $password, $confirmation;
    public $nombre, $apellidos, $id_tipo_doc_id, $num_doc_id, $tel_movil, $tel_fijo;
    public $skype, $paypal, $facebook, $linkedin, $twitter, $youtube;
    public $direccion, $codigo_postal, $munic, $prov, $id_pais;
    public $referido_por, $term_condic, $id_curso;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'email', 'password', 'confirmation', 'id_pais', 'nombre', 'apellidos', 'id_tipo_doc_id', 'num_doc_id', 'term_condic', 'paypal', 'tel_movil', 'direccion', 'codigo_postal', 'prov', 'munic'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['tel_movil', 'integer'],

            ['email', 'filter', 'filter' => 'trim'],
            [['email', 'paypal'], 'email', 'message' => SiteController::translate('This field has an incorrect format')],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],

            ['password', 'string', 'min' => 6],
            
            ['confirmation', 'compare', 'compareAttribute' => 'password', 'operator' => '==', 'skipOnEmpty' => false, 'message' => SiteController::translate('New password does not match')],
            
            ['nombre', 'string', 'min' => 1, 'max' => 50],
            
            ['apellidos', 'string', 'min' => 1, 'max' => 100],
            
            [['munic', 'prov'], 'string', 'min' => 2, 'max' => 75],
            
            ['term_condic', 'boolean'],
            ['term_condic', 'in', 'range' => [1], 'message' => SiteController::translate('You must accept terms and conditions to continue')],
            
            ['tel_movil', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['skype', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['paypal', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['facebook', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['linkedin', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['twitter', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            ['youtube', 'unique', 'targetClass' => '\app\models\User', 'message' => SiteController::translate('Another user has already registered with this information')],
            
            ['id_curso', 'exist', 'targetClass' => '\app\models\Producto', 'message' => SiteController::translate('This element does not exist')],
            
            [['username', 'email', 'password', 'confirmation',
            'nombre', 'apellidos', 'id_tipo_doc_id', 'num_doc_id', 'tel_movil', 'tel_fijo',
            'skype', 'paypal', 'facebook', 'linkedin', 'twitter', 'youtube',
            'direccion', 'codigo_postal', 'munic', 'prov', 'id_pais',
            'referido_por', 'term_condic'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => SiteController::translate('Username'),
            'auth_key' => SiteController::translate('Authorization Key'),
            'password' => SiteController::translate('Password'),
            'confirmation' => SiteController::translate('Confirm new password'),
            'password_reset_token' => SiteController::translate('Password Reset Token'),
            'email' => SiteController::translate('Email'),
            'status' => SiteController::translate('Status'),
            'rol_id' => SiteController::translate('Role'),
            'nombre' => SiteController::translate('Name'),
            'apellidos' => SiteController::translate('Surname'),
            'id_tipo_doc_id' => SiteController::translate('Identification document'),
            'num_doc_id' => SiteController::translate('Identification number'),
            'tel_movil' => SiteController::translate('Mobile phone'),
            'tel_fijo' => SiteController::translate('Telephone'),
            'skype' => 'Skype',
            'paypal' => 'PayPal',
            'facebook' => 'Facebook',
            'linkedin' => 'LinkedIn',
            'twitter' => 'Twitter',
            'youtube' => 'Youtube',
            'direccion' => SiteController::translate('Address'),
            'codigo_postal' => SiteController::translate('PO Box'),
            'munic' => SiteController::translate('Municipality'),
            'prov' => SiteController::translate('Province'),
            'id_pais' => SiteController::translate('Country'),
            'referido_por' => SiteController::translate('Invited by'),
            'term_condic' => SiteController::translate('I agree with terms and conditions.'),
            'id_nivel_acceso' => SiteController::translate('Access level'),
            'created_at' => SiteController::translate('Created at'),
            'updated_at' => SiteController::translate('Modified at'),
            'id_curso' => SiteController::translate('Course to buy'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($id_curso)
    {
        if ($this->validate())
        {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            
            $user->nombre = $this->nombre;
            $user->apellidos = $this->apellidos;
            $user->id_tipo_doc_id = $this->id_tipo_doc_id;
            $user->num_doc_id = $this->num_doc_id;
            $user->tel_movil = $this->tel_movil;
            $user->tel_fijo = $this->tel_fijo;
            $user->skype = $this->skype;
            $user->paypal = $this->paypal;
            $user->facebook = $this->facebook;
            $user->linkedin = $this->linkedin;
            $user->twitter = $this->twitter;
            $user->youtube = $this->youtube;
            $user->direccion = $this->direccion;
            $user->codigo_postal = $this->codigo_postal;
            $user->munic = $this->munic;
            $user->prov = $this->prov;
            $user->id_pais = $this->id_pais;
            $user->referido_por = $this->referido_por;
            $user->term_condic = $this->term_condic;
            $user->id_nivel_acceso = null;
            $user->rol_id = 1;
            $user->credito_comisiones = 0;
            $user->credito_circuitos = 0;
            $user->idioma = 'es-ES';
            $user->status = (isset($id_curso)) ? 1 : 0;
            
            if ($user->save())
            {
                return $user;
            }
            else
            {
                $pp = $this->errors;
                return null;
            }
        }
        else
        {
            $pp = $this->errors;
            return null;
        }
    }
    
    public function sendEmail($user, $password, $id_curso)
    {
        if ($user)
        {
            return Yii::$app->mailer->compose(['html' => 'userActivation-html', 'text' => 'userActivation-text'], ['user' => $user, 'password' => $password, 'id_curso' => $id_curso])
                ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject(SiteController::translate('Account activation for user ') . $user->username . SiteController::translate(' on ') . Yii::$app->name)
                ->send();
        }

        return false;
    }
}
