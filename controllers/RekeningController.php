<?php
namespace app\controllers;
use Yii;
use app\models\MRekening;
use app\models\MRekeningSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
class RekeningController extends Controller
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
        $searchModel = new MRekeningSearch();
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
                'title' => "Rekening #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
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
        $model = new MRekening();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Rekening",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'fotoNpwp'))) {
                    $ext = Yii::$app->tools->upload('MRekening[fotoNpwp]', Yii::getAlias('@uploads') . $model->data->nip . '/npwp_' . $model->npwp);
                    $model->fotoNpwp = $ext;
                }
                if (!empty(UploadedFile::getInstance($model, 'fotoRekening'))) {
                    $ext = Yii::$app->tools->upload('MRekening[fotoRekening]', Yii::getAlias('@uploads') . $model->data->nip . '/rek_' . $model->nomor_rekening);
                    $model->fotoRekening = $ext;
                }
                $model->save(false);
                return [
                    'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax',
                    'title' => "Create new Rekening",
                    'content' => '<span class="text-success">Create Rekening success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Create new Rekening",
                    'content' => $this->renderAjax('create', [
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
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldNpwp = $model->fotoNpwp;
        $oldRekening = $model->fotoRekening;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Rekening #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'fotoNpwp'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $oldNpwp) && !empty($oldFoto)) {
                        unlink($filename);
                    }
                    $model->fotoNpwp =Yii::$app->tools->upload('MRekening[fotoNpwp]', Yii::getAlias('@uploads') . $model->data->nip . '/npwp_' . $model->npwp);
                } else {
                    $model->fotoNpwp = $oldNpwp;
                }
                if (!empty(UploadedFile::getInstance($model, 'fotoRekening'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $oldRekening) && !empty($oldFoto)) {
                        unlink($filename);
                    }
                    $model->fotoRekening = Yii::$app->tools->upload('MRekening[fotoRekening]', Yii::getAlias('@uploads') . $model->data->nip . '/rek_' . $model->nomor_rekening);
                } else {
                    $model->fotoRekening = $oldRekening;
                }
                $model->save(false);
                return [
                    'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax',
                    'title' => "Rekening #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update Rekening #" . $id,
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
        $model=$this->findModel($id);
        if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoNpwp) && !empty($model->fotoNpwp)){
            unlink($filename);
        }
        if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoRekening) && !empty($model->fotoRekening)){
            unlink($filename);
        }
        $model->delete();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks'));
        foreach ($pks as $pk) {
            $model=$this->findModel($pk);
            if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoNpwp) && !empty($model->fotoNpwp)){
                unlink($filename);
            }
            if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoRekening) && !empty($model->fotoRekening)){
                unlink($filename);
            }
            $model->delete();
        }
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }
    protected function findModel($id)
    {
        if (($model = MRekening::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
