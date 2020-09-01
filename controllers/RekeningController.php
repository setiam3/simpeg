<?php

namespace app\controllers;

use Yii;
use app\models\MRekening;
use app\models\MRekeningSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RekeningController implements the CRUD actions for MRekening model.
 */
class RekeningController extends Controller
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
     * Lists all MRekening models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MRekeningSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MRekening model.
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
     * Creates a new MRekening model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MRekening();

        if ($model->load(Yii::$app->request->post())) {
<<<<<<< HEAD
            if (!empty(UploadedFile::getInstance($model, 'fotoNpwp'))) {
                $ext = Yii::$app->tools->upload('MRekening[fotoNpwp]', Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->npwp);
                $model->fotoNpwp = $model->npwp . '.' . $ext;
            }
            if (!empty(UploadedFile::getInstance($model, 'fotoRekening'))) {
                $ext = Yii::$app->tools->upload('MRekening[fotoRekening]', Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->nomor_rekening);
                $model->fotoRekening = $model->nomor_rekening . '.' . $ext;
=======
            if(!empty(UploadedFile::getInstance($model, 'fotoNpwp'))){
                $ext=Yii::$app->tools->upload('MRekening[fotoNpwp]',Yii::getAlias('@uploads').$model->data->nip.'/npwp_'.$model->npwp);
                $model->fotoNpwp='npwp_'.$model->npwp.'.'.$ext;
            }
            if(!empty(UploadedFile::getInstance($model, 'fotoRekening'))){
                $ext=Yii::$app->tools->upload('MRekening[fotoRekening]',Yii::getAlias('@uploads').$model->data->nip.'/rek_'.$model->nomor_rekening);
                $model->fotoRekening='rek_'.$model->nomor_rekening.'.'.$ext;
>>>>>>> 0b72893f4fcaf6944f9954837b4747c722b1fd05
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
     * Updates an existing MRekening model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldNpwp = $model->fotoNpwp;
        $oldRekening = $model->fotoRekening;
        if ($model->load(Yii::$app->request->post())) {
<<<<<<< HEAD
            if (!empty(UploadedFile::getInstance($model, 'fotoNpwp'))) {
                $ext = Yii::$app->tools->upload('MRekening[fotoNpwp]', Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->npwp);
                $model->fotoNpwp = $model->npwp . '.' . $ext;
            } else {
                $model->fotoNpwp = $oldimage;
            }
            if (!empty(UploadedFile::getInstance($model, 'fotoRekening'))) {
                $ext = Yii::$app->tools->upload('MRekening[fotoRekening]', Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->nomor_rekening);
                $model->fotoRekening = $model->nomor_rekening . '.' . $ext;
            } else {
                $model->fotoRekening = $oldimage2;
=======
            if(!empty(UploadedFile::getInstance($model, 'fotoNpwp'))){
                if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$oldNpwp)){
                    unlink($filename);
                }
                $ext=Yii::$app->tools->upload('MRekening[fotoNpwp]',Yii::getAlias('@uploads').$model->data->nip.'/npwp_'.$model->npwp);
                $model->fotoNpwp='npwp_'.$model->npwp.'.'.$ext;
            }else{
                $model->fotoNpwp=$oldNpwp;
            }
            if(!empty(UploadedFile::getInstance($model, 'fotoRekening'))){
                if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$oldRekening)){
                    unlink($filename);
                }
                $ext=Yii::$app->tools->upload('MRekening[fotoRekening]',Yii::getAlias('@uploads').$model->data->nip.'/rek_'.$model->nomor_rekening);
                $model->fotoRekening='rek_'.$model->nomor_rekening.'.'.$ext;
            }else{
                $model->fotoRekening=$oldRekening;
>>>>>>> 0b72893f4fcaf6944f9954837b4747c722b1fd05
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
     * Deletes an existing MRekening model.
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
     * Finds the MRekening model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MRekening the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MRekening::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
