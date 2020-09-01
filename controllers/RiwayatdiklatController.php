<?php

namespace app\controllers;

use Yii;
use app\models\MRiwayatdiklat;
use app\models\MRiwayatdiklatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * RiwayatdiklatController implements the CRUD actions for MRiwayatdiklat model.
 */
class RiwayatdiklatController extends Controller
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
     * Lists all MRiwayatdiklat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MRiwayatdiklatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MRiwayatdiklat model.
     * @param integer $id
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
     * Creates a new MRiwayatdiklat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MRiwayatdiklat();

        if ($model->load(Yii::$app->request->post())) {
            if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                $ext = Yii::$app->tools->upload('MRiwayatdiklat[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ridik_' . $model->data->nip . '_' . time());
                $model->dokumen = 'ridik_' . $model->data->nip . '_' . time() . '.' . $ext;
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MRiwayatdiklat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $olddokumen = $model->dokumen;
        if ($model->load(Yii::$app->request->post())) {
            if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $olddokumen)) {
                    unlink($filename);
                }
                $ext = Yii::$app->tools->upload('MRiwayatdiklat[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ridik_' . $model->data->nip . '_' . time());
                $model->dokumen = 'ridik_' . $model->data->nip . '_' . time() . '.' . $ext;
            } else {
                $model->dokumen = $olddokumen;
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MRiwayatdiklat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MRiwayatdiklat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MRiwayatdiklat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MRiwayatdiklat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
