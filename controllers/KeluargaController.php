<?php
namespace app\controllers;
use Yii;
use app\models\MBiodata;
use app\models\MKeluargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
class KeluargaController extends Controller
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
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where = ['parent_id' => \Yii::$app->user->identity->id_data];
        } else {
            $where = '';
        }
        $searchModel = new MKeluargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
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
                'title' => "Data Keluarga #" . $id,
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
        $model = new MBiodata();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Data Keluarga",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $model->is_pegawai = 0;
                if (!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))) {
                    $ext = Yii::$app->tools->upload('MBiodata[foto]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $foto = 'foto_' . $model->status_hubungan_keluarga . '_' . $model->parent_id);
                    $model->foto = $ext;
                }
                if (!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))) {
                    $ext = Yii::$app->tools->upload('MBiodata[fotoNik]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $fotoNik = 'fotoNik_' . $model->status_hubungan_keluarga . '_' . $model->nik);
                    $model->fotoNik = $ext;
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Data Keluarga",
                    'content' => '<span class="text-success">Create Data Keluarga success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Data Keluarga",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post())) {
                $model->is_pegawai = 0;
                if (!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))) {
                    $ext = Yii::$app->tools->upload('MBiodata[foto]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $foto = 'foto_' . $model->status_hubungan_keluarga . '_' . $model->parent_id);
                    $model->foto = $ext;
                }
                if (!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))) {
                    $ext = Yii::$app->tools->upload('MBiodata[fotoNik]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $fotoNik = 'fotoNik_' . $model->status_hubungan_keluarga . '_' . $model->nik);
                    $model->fotoNik = $ext;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id_data]);
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
        $oldFoto = $model->foto;
        $oldFotoNik = $model->fotoNik;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Data Keluarga #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $model->is_pegawai = 0;
                if (!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $oldFoto) && !empty($oldFoto)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('MBiodata[foto]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $foto = 'foto_' . $model->status_hubungan_keluarga . '_' . $model->parent_id);
                    $model->foto = $ext;
                }
                if (!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $oldFotoNik) && !empty($oldFotoNik)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('MBiodata[fotoNik]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $fotoNik = 'fotoNik_' . $model->status_hubungan_keluarga . '_' . $model->nik);
                    $model->fotoNik = $ext;
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Data Keluarga #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update Data Keluarga #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $oldFoto) && !empty($oldFoto)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('MBiodata[foto]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $foto = 'foto_' . $model->status_hubungan_keluarga . '_' . $model->parent_id);
                    $model->foto = $ext;
                }
                if (!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $oldFotoNik) && !empty($oldFotoNik)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('MBiodata[fotoNik]', Yii::getAlias('@uploads') . $model->parent->nip . '/' . $fotoNik = 'fotoNik_' . $model->status_hubungan_keluarga . '_' . $model->nik);
                    $model->fotoNik = $ext;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id_data]);
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
        if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $model->foto) && !empty($model->foto)) {
            unlink($filename);
        }
        if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $model->fotoNik) && !empty($model->fotoNik)) {
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
            if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $model->foto) && !empty($model->foto)) {
                unlink($filename);
            }
            if (file_exists($filename = Yii::getAlias('@uploads') . $model->parent->nip . '/' . $model->fotoNik) && !empty($model->fotoNik)) {
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
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('admin', $role) || in_array('operator', $role)) {
            if (($model = MBiodata::findOne($id)) !== null) {
                return $model;
            }
            throw new NotFoundHttpException('The requested page does not exist.');
        } elseif (($model = MBiodata::find()->where(['parent_id' => \Yii::$app->user->identity->id_data, 'id_data' => $id])->one()) !== null) {
            return $model;
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        throw new ForbiddenHttpException;
    }
}
