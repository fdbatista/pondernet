<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\search\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\AccessHelpers;
use app\models\auditoria\CategoriaAudit;
use app\models\auditoria\ContAudit;
use app\models\Producto;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
{
    public $layout = 'main';
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;
        $operacion = Yii::$app->controller->route;
        if (in_array($operacion, ['categoria/index', 'categoria/view']))
            return true;
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
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $layout = 'main-admin';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categoria model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*$cursos = \app\models\Producto::find()->where(['id_categoria' => $id])->all();
        return $this->render('view', ['model' => $this->findModel($id), 'cursos' => $cursos]);*/
        $query = Producto::find()->where(['id_categoria' => $id]);
        $count = $query->count();
        $pagination = new \yii\data\Pagination(['totalCount' => $count]);
        $pagination->setPageSize(9);
        $cursos = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        return $this->render('view', ['model' => $this->findModel($id), 'cursos' => $cursos, 'pagination' => $pagination]);
    }

    /**
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();
        $this->layout = 'main-admin';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $objAudit = new ContAudit(Yii::$app->controller->route, null, new CategoriaAudit($model));
            AuditoriaController::generarTraza($objAudit);
            return $this->redirect(['admin']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = 'main-admin';
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $objAudit = new ContAudit(Yii::$app->controller->route, null, new CategoriaAudit($model));
            AuditoriaController::generarTraza($objAudit);
            return $this->redirect(['admin']);
        }
        else
        {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->layout = 'main-admin';
        $model = $this->findModel($id);
        $model->delete();
        $objAudit = new ContAudit(Yii::$app->controller->route, null, new CategoriaAudit($model));
        AuditoriaController::generarTraza($objAudit);
        return $this->redirect(['admin']);
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAdmin()
    {
        $searchModel = new CategoriaSearch();
        $this->layout = 'main-admin';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'layout' => 'main-admin',
        ]);
    }
    
}
