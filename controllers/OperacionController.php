<?php

namespace app\controllers;

use Yii;
use app\models\Operacion;
use app\models\search\OperacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\AccessHelpers;
use app\models\auditoria\ContAudit;
use app\models\auditoria\OperacionAudit;
/**
 * OperacionController implements the CRUD actions for Operacion model.
 */
class OperacionController extends Controller
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
     * Lists all Operacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OperacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Operacion model.
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
     * Creates a new Operacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        try
        {
            $model = new Operacion();
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                $objAudit = new ContAudit(Yii::$app->controller->route, null, new OperacionAudit($model));
                AuditoriaController::generarTraza($objAudit);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('create', ['model' => $model,]);
            }
        }
        catch (\yii\base\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render('create', ['model' => $model,]);
        }

        
    }

    /**
     * Updates an existing Operacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $objAudit = new ContAudit(Yii::$app->controller->route, null, new OperacionAudit($model));
            AuditoriaController::generarTraza($objAudit);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Operacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $objAudit = new ContAudit(Yii::$app->controller->route, null, new OperacionAudit($model));
        AuditoriaController::generarTraza($objAudit);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Operacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Operacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Operacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
