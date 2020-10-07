<?php
namespace app\controllers;
use Yii;
use app\models\Riwayatpendidikan;
use app\models\RiwayatpendidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
class RiwayatpendidikanController extends Controller
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
        $searchModel = new RiwayatpendidikanSearch();
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
                'title' => "Riwayatpendidikan #" . $id,
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
        $model = new Riwayatpendidikan();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Riwayatpendidikan",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstanceByName('Riwayatpendidikan[dokumen]'))) {
                    $model->dokumen = Yii::$app->tools->upload('Riwayatpendidikan[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ripen' . $model->data->nip);
                }
                if ($model->save()) {
                    return [
                        'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                        'title' => "Create new Riwayatpendidikan",
                        'content' => '<span class="text-success">Create Riwayatpendidikan success</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                    ];
                }
            } else {
                return [
                    'title' => "Create new Riwayatpendidikan",
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
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldFoto = $model->dokumen;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Riwayatpendidikan #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstanceByName('Riwayatpendidikan[dokumen]'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $oldFoto) && !empty($oldFoto)) {
                        unlink($filename);
                    }
                    $model->dokumen = Yii::$app->tools->upload('Riwayatpendidikan[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ripen' .  $model->data->nip);
                } else {
                    $model->dokumen = $oldFoto;
                }
                $model->save();
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Riwayatpendidikan #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update Riwayatpendidikan #" . $id,
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
        if (($model = Riwayatpendidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
