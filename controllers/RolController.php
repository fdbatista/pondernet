<?php

namespace app\controllers;

use Yii;
use app\models\Operacion;
use app\models\Rol;
use app\models\search\RolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\AccessHelpers;
use app\models\auditoria\ContAudit;
use app\models\auditoria\RolAudit;

/**
 * RolController implements the CRUD actions for Rol model.
 */
class RolController extends Controller
{
    public $layout = 'main-admin';
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;
        $operacion = Yii::$app->controller->route;
        if (AccessHelpers::getAcceso($operacion))
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
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Rol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rol model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rol();
        $tipoOperaciones = Operacion::find()->orderBy('nombre')->all();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $objAudit = new ContAudit(Yii::$app->controller->route, null, new RolAudit($model));
            AuditoriaController::generarTraza($objAudit);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model, 'tipoOperaciones' => $tipoOperaciones]);
}

    /**
     * Updates an existing Rol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tipoOperaciones = Operacion::find()->orderBy('nombre')->all();
        $model->operaciones = ArrayHelper::getColumn($model->getRolOperaciones()->asArray()->all(), 'operacion_id');
        if ($model->load(Yii::$app->request->post()))
        {
            if (!isset($_POST['Rol']['operaciones']))
                $model->operaciones = [];
            if ($model->save())
            {
                $objAudit = new ContAudit(Yii::$app->controller->route, null, new RolAudit($model));
                AuditoriaController::generarTraza($objAudit);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        else
            return $this->render('update', ['model' => $model, 'tipoOperaciones' => $tipoOperaciones]);
    }

    /**
     * Deletes an existing Rol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $objAudit = new ContAudit(Yii::$app->controller->route, null, new RolAudit($model, false));
        AuditoriaController::generarTraza($objAudit);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rol::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
