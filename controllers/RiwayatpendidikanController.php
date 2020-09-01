<?php

namespace app\controllers;

use Yii;
use app\models\Riwayatpendidikan;
use app\models\RiwayatpendidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RiwayatpendidikanController implements the CRUD actions for Riwayatpendidikan model.
 */
class RiwayatpendidikanController extends Controller
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
     * Lists all Riwayatpendidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RiwayatpendidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Riwayatpendidikan model.
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
     * Creates a new Riwayatpendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Riwayatpendidikan();

        if ($model->load(Yii::$app->request->post())) {
            if (!empty(UploadedFile::getInstanceByName('Riwayatpendidikan[dokumen]'))) {
                $ext = Yii::$app->tools->upload('Riwayatpendidikan[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->pendidikan->nama_referensi . '_' . $model->data->nip);
                $model->dokumen = $model->pendidikan->nama_referensi . '_' . $model->data->nip . '.' . $ext;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', ($model->dokumen) . ' row inserted');
            } else {
                Yii::$app->session->setFlash('error', ' failed insert row');
            }

            // return $this->redirect(['create']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Riwayatpendidikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $oldFoto=$model->dokumen;
            if(!empty(UploadedFile::getInstanceByName('Riwayatpendidikan[dokumen]'))){
                if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$oldFoto) && !empty($oldFoto)){
                    unlink($filename);
                }
                $ext=Yii::$app->tools->upload('Riwayatpendidikan[dokumen]',Yii::getAlias('@uploads').$model->data->nip.'/'.$model->pendidikan->nama_referensi.'_'.$model->data->nip);
                $model->dokumen=$model->pendidikan->nama_referensi.'_'.$model->data->nip.'.'.$ext;
            }else{
                $model->dokumen=$oldFoto;
            }
            if($model->save()) {
                Yii::$app->session->setFlash('success', ($model->dokumen).' row inserted');
            }else{
                Yii::$app->session->setFlash('error',' failed insert row');
            }
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Riwayatpendidikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->dokumen;
        if (file_exists($filename)) {
            unlink($filename);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Riwayatpendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Riwayatpendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Riwayatpendidikan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
