<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\User;
use app\models\PasswordResetRequestForm;
use yii\filters\VerbFilter;
//use yii\base\InvalidParamException;
//use yii\web\BadRequestHttpException;
use app\models\ResetPasswordForm;
use app\models\AccessHelpers;

/**
 * Site controller
 */
class AdminController extends Controller
{
    public $layout = 'main-admin';
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'signup', 'request-password-reset', 'reset-password',],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout',],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
 
        $operacion = Yii::$app->controller->route;
        
        if (!AccessHelpers::getAcceso($operacion)) {
            //throw new BadRequestHttpException(SiteController::translate('You are not allowed to perform this action.'));
            echo $this->render('/site/error', ['name' => 'Error', 'message' => 'You are not allowed to perform this action.']);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    private function actualizarIntentosFallidos($usuario, $resetear = false)
    {
        $model = User::findByUsername($usuario);
        if ($model)
        {
            if ($resetear)
                $model->intentos_cnx_fallidos = 0;
            else
                $model->intentos_cnx_fallidos++;
            $model->save(false);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        $model->load(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->login())
            {
                $this->actualizarIntentosFallidos($model->username, true);
                return $this->goBack();
            }
            else
            {
                $estado = User::getStatus($model->username);
                if ($estado == '0')
                    Yii::$app->session->setFlash('warning', 'Su cuenta ha sido declarada inactiva. Diríjase a la página de restablecimiento de contraseña.');
                else if ($estado == '2')
                    Yii::$app->session->setFlash('warning', 'Su cuenta ha sido bloqueada por superar el límite de intentos de acceso fallidos. Contacte al administrador del sistema para desbloquearla.');
                else
                    $this->actualizarIntentosFallidos($model->username);
                return $this->render('login', ['model' => $model]);
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
    public function actionRequestPasswordReset()
    {
        try
        {
            $model = new PasswordResetRequestForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                if ($model->sendEmail())
                {
                    Yii::$app->session->setFlash('success', 'Por favor, verifique su correo electrónico para completar el proceso.');
                    return $this->goHome();
                }
                else
                {
                    Yii::$app->session->setFlash('danger', 'No se ha podido generar el código para la dirección de correo especificada.');
                }
            }
            return $this->render('request-password-reset', ['model' => $model,]);
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render('request-password-reset', ['model' => $model,]);
        }
    }
    
    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        }
        catch (\yii\base\Exception $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', 'Su contraseña ha sido actualizada.');
            return $this->goHome();
        }

        return $this->render('reset-password', ['model' => $model,]);
    }

}
