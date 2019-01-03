<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\AccessHelpers;
use app\models\User;
use yii\filters\VerbFilter;

class HoverController extends Controller
{
    public $layout = 'hover';
    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->session['language']))
            Yii::$app->session->set('language', 'es-ES');
        
        if (!parent::beforeAction($action)) {
            return false;
        }
 
        $operacion = Yii::$app->controller->route;
        if (in_array($operacion, ['site/retirar-fondos', 'site/captcha', 'site/activate-user', 'site/logout', 'site/oficina', 'site/change-language', 'site/request-password-reset', 'site/reset-password', 'site/index', 'site/error', 'site/signup', 'site/about', 'site/contact', 'site/login', 'site/activate-user'])) {
            return true;
        }

        if (!AccessHelpers::getAcceso($operacion)) {
            throw new BadRequestHttpException(self::translate('You are not allowed to perform this action.'));
        }

        return true;
    }
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['request-password-reset', 'login', 'signup'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'about', 'contact', 'logout', 'error', 'change-language', 'change-password', 'my-profile', 'update-profile', 'oficina', 'afiliado', 'invitar', 'retirar-fondos', 'captcha', 'activate-user', 'cobrar-bono', 'usuario'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'about', 'contact', 'login', 'signup', 'error', 'request-password-reset', 'activate-user', 'reset-password', 'change-language', 'captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'id' => 'captcha'
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        return 'verga';
    }
    
    public function actionUsuario($id)
    {
        return $this->render('usuario', ['model' => User::find()->where(['id' => $id])->orWhere(['username' => $id])->one()]);
    }
    
    public static function hoverCard($id)
    {
        $user = User::find()->where(['id' => $id])->orWhere(['username' => $id])->one();
        return $user->username . ' (' . $user->email . ')';
    }
}

?>