<?php

namespace app\controllers;

use Yii;
use app\models\Auditoria;
use app\models\search\AuditoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AuditoriaController extends Controller
{
    public $layout = 'main-admin';
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;
        $operacion = Yii::$app->controller->route;
        if (\app\models\AccessHelpers::getAcceso($operacion))
            return true;
        echo $this->render('/site/error', ['name' => 'Error', 'message' => 'No tiene permiso para ejecutar la acción solicitada']);
        return false;
    }
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new AuditoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }
    
    protected function findModel($id)
    {
        if (($model = Auditoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public static function generarTraza($objAudit)
    {
        if (\app\models\AppConfig::findOne(1)->activar_log)
        {
            $model = new \app\models\Auditoria();
            $model->operacion = $objAudit->operacion;
            $model->producto = $objAudit->producto;
            $model->ip = $objAudit->ip;
            $model->autor = $objAudit->autor;
            $model->detalles = self::getContenidoArreglo($objAudit->model->getAttributes());
            $model->save(false);
        }
    }
    
    public static function getContenidoArreglo($arreglo)
    {
        $result = '';
        foreach ($arreglo as $key => $value)
        {
            if (!is_array($value))
            {
                if ($value)
                    $result .= strtoupper($key) . ": $value, ";
            }
            else
            {
                $result = trim($result, ', ') . '. ' . $key . ': ';
                $result .= self::getContenidoArreglo($value);
            }
        }
        return trim($result, ', ');
    }
}
