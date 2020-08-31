<?php
namespace app\controllers;
use Yii;
use app\models\MBiodata;
use app\models\MBiodataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class BiodataController extends Controller
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
     * Lists all MBiodata models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MBiodataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MBiodata model.
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
     * Creates a new MBiodata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MBiodata();

        if ($model->load(Yii::$app->request->post()) ) {
            if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                $ext=Yii::$app->tools->upload('MBiodata[foto]',Yii::getAlias('@uploads').$model->nip);
                $model->foto=$model->nip.'.'.$ext;
            }
            if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                $ext=Yii::$app->tools->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$model->nik);
                $model->fotoNik=$model->nik.'.'.$ext;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_data]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MBiodata model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFoto=$model->foto;
        $oldFotoNik=$model->fotoNik;
        if ($model->load(Yii::$app->request->post()) ) {
            if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                $ext=Yii::$app->tools->upload('MBiodata[foto]',Yii::getAlias('@uploads').$model->nip.'/'.$model->nip);
                $model->foto=$model->nip.'.'.$ext;
            }else{
                $model->foto=$oldFoto;
            }
            if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                $ext=Yii::$app->tools->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$model->nip.'/'.$model->nik);
                $model->fotoNik=$model->nik.'.'.$ext;
            }else{
                $model->fotoNik=$oldFotoNik;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_data]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MBiodata model.
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
     * Finds the MBiodata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MBiodata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MBiodata::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
