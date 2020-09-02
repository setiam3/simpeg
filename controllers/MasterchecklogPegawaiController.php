<?php

namespace app\controllers;

use Yii;
use app\models\MmasterchecklogPegawai;
use app\models\MBiodata;
use app\models\MmasterchecklogPegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterchecklogPegawaiController implements the CRUD actions for MmasterchecklogPegawai model.
 */
class MasterchecklogPegawaiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MmasterchecklogPegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MmasterchecklogPegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MmasterchecklogPegawai model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MmasterchecklogPegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MmasterchecklogPegawai();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $biodata = MBiodata::findOne($model->id_data);
            $biodata->checklog_id = $model->checklogpegawai_id;
            if($biodata->update()){
                return $this->redirect(['view', 'id' => $model->checklogpegawai_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MmasterchecklogPegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $biodata = MBiodata::findOne($model->id_data);
            $biodata->checklog_id = $model->checklogpegawai_id;
            if($biodata->update()){
                return $this->redirect(['view', 'id' => $model->checklogpegawai_id]);
            }
            // return $this->redirect(['view', 'id' => $model->checklogpegawai_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MmasterchecklogPegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MmasterchecklogPegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MmasterchecklogPegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MmasterchecklogPegawai::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
