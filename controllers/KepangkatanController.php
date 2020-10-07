<?php
namespace app\controllers;
use Yii;
use app\models\MKepangkatan;
use app\models\MKepangkatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
class KepangkatanController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new MKepangkatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Kepangkatan #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MKepangkatan();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Kepangkatan",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                    $model->dokumen = Yii::$app->tools->upload('MKepangkatan[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/Kepangkatan' . $model->data->nip);
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Create new Kepangkatan",
                    'content' => '<span class="text-success">Create MKepangkatan success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Create new Kepangkatan",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionGetgajipokok(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $gapok=MKepangkatan::find()->where(['id_data'=>$_POST['id']])->one();
            if(!empty($gapok)){
                return $gapok->penggolongangaji->gaji;
            }else{
                return 0;
            }
        }
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $olddokumen = $model->dokumen;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Kepangkatan #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                    $model->dokumen = Yii::$app->tools->upload('MKepangkatan[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/kepangkatan_' . $model->data->nip);
                } else {
                    $model->dokumen = $olddokumen;
                }
                $model->save();
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Kepangkatan #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update Kepangkatan #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->dokumen) && !empty($model->dokumen)) {
            unlink($filename);
        }
        $model->delete();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks'));
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->dokumen) && !empty($model->dokumen)) {
                unlink($filename);
            }
            $model->delete();
        }
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }
    protected function findModel($id)
    {
        if (($model = MKepangkatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
