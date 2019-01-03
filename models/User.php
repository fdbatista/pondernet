<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\controllers\SiteController;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $rol_id
 * @property string $nombre
 * @property string $apellidos
 * @property string $id_tipo_doc_id
 * @property string $num_doc_id
 * @property string $tel_movil
 * @property string $tel_fijo
 * @property string $skype
 * @property string $paypal
 * @property string $facebook
 * @property string $linkedin
 * @property string $twitter
 * @property string $youtube
 * @property string $direccion
 * @property string $codigo_postal
 * @property string $munic
 * @property string $prov
 * @property string $id_pais
 * @property string $referido_por
 * @property boolean $term_condic
 * @property string $id_nivel_acceso
 * @property string $idioma
 * @property integer $intentos_cnx_fallidos
 * @property integer $credito_comisiones
 * @property integer $credito_circuitos
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CursoAbonado[] $cursoAbonados
 * @property Producto[] $productos
 * @property Pagos[] $pagos
 * @property IntentoCnxFallido $intentoCnxFallido
 * @property NivelAcceso $idNivelAcceso
 * @property TipoDocId $idTipoDoc
 * @property Rol $rol
 * @property Pais $idPais
 */

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = -1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_LOCKED = 2;
    const FAILED_LOGON_ATTEMPTS = 3;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_INACTIVE, self::STATUS_ACTIVE, self::STATUS_LOCKED]],
            [['intentos_cnx_fallidos'], 'integer', 'max' => self::FAILED_LOGON_ATTEMPTS],
            [['username', 'auth_key', 'password_hash', 'email', 'nombre', 'apellidos', 'id_tipo_doc_id', 'num_doc_id', 'id_pais', 'paypal', 'tel_movil', 'direccion', 'codigo_postal', 'prov', 'munic'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            [['status', 'rol_id', 'id_tipo_doc_id', 'tel_movil', 'tel_fijo', 'id_pais', 'referido_por', 'id_nivel_acceso', 'intentos_cnx_fallidos', 'created_at', 'updated_at'], 'integer'],
            [['term_condic'], 'boolean'],
            [['term_condic'], 'default', 'value' => true],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['nombre', 'skype', 'paypal'], 'string', 'max' => 50],
            [['apellidos'], 'string', 'max' => 100],
            [['num_doc_id'], 'string', 'max' => 25],
            [['facebook', 'linkedin', 'twitter', 'youtube', 'direccion'], 'string', 'max' => 250],
            [['codigo_postal'], 'string', 'max' => 10],
            [['idioma'], 'string', 'max' => 7],
            [['username', 'email'], 'unique', 'message' => SiteController::translate('Another user has already registered with this information')],
            [['password_reset_token'], 'unique'],
            [['email', 'paypal'], 'email', 'message' => SiteController::translate('This field has an incorrect format')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => SiteController::translate('ID'),
            'username' => SiteController::translate('Username'),
            'auth_key' => SiteController::translate('Auth Key'),
            'password_hash' => SiteController::translate('Password'),
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
            'skype' => SiteController::translate('Skype'),
            'paypal' => SiteController::translate('Paypal'),
            'facebook' => SiteController::translate('Facebook'),
            'linkedin' => SiteController::translate('Linkedin'),
            'twitter' => SiteController::translate('Twitter'),
            'youtube' => SiteController::translate('Youtube'),
            'direccion' => SiteController::translate('Address'),
            'codigo_postal' => SiteController::translate('PO Box'),
            'munic' => SiteController::translate('Municipality'),
            'prov' => SiteController::translate('Province'),
            'id_pais' => SiteController::translate('Country'),
            'referido_por' => SiteController::translate('Referred by'),
            'term_condic' => SiteController::translate('I agree with terms and conditions.'),
            'id_nivel_acceso' => SiteController::translate('Access level'),
            'intentos_cnx_fallidos' => SiteController::translate('Failed logon attempts'),
            'created_at' => SiteController::translate('Created at'),
            'updated_at' => SiteController::translate('Modified at'),
        ];
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id' => 'producto_id'])->viaTable('curso_abonado', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntentoCnxFallido()
    {
        return $this->hasOne(IntentoCnxFallido::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNivelAcceso()
    {
        return $this->hasOne(NivelAcceso::className(), ['id' => 'id_nivel_acceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoDoc()
    {
        return $this->hasOne(TipoDocId::className(), ['id' => 'id_tipo_doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(\app\models\Rol::className(), ['id' => 'rol_id']);
    }

    public function getCursoAbonados()
    {
        return $this->hasMany(\app\models\CursoAbonado::className(), ['user_id' => 'id']);
    }
    
    public function getPagos()
    {
        return $this->hasMany(\app\models\Pagos::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'id_pais']);
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_INACTIVE]);
    }
    
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token))
            return null;
        return static::findOne(['password_reset_token' => $token, 'status' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]]);
    }
    
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public static function isLocked($username)
    {
        if (static::findOne(['username' => $username, 'status' => self::STATUS_LOCKED]))
            return true;
        return false;
    }
    
    public static function getStatus($username)
    {
        $user = static::findOne(['username' => $username]);
         return (isset($user['status'])) ? $user['status'] : null;
    }
    
    public function setAttribute($name, $value) {
        parent::setAttribute($name, $value);
    }
}
