<?php

namespace app\controllers;

use app\models\TransaksiPenggajianSearch;
use Yii;
use app\models\MBiodata;
use app\models\MBiodataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\MKeluargaSearch;
use app\models\RiwayatdiklatSearch;
use app\models\Riwayatjabatan;
use app\models\RiwayatjabatanSearch;
use app\models\RiwayatpendidikanSearch;
//use app\models\TransaksiPenggajianSearch;

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
    public function actionInfo($id)
    {
        $searchModel = new MBiodataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('infopegawai', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelKeluarga' => new MKeluargaSearch(),
            'searchModelpendidikan' => new RiwayatpendidikanSearch(),
            'searchModeldiklat' => new RiwayatdiklatSearch(),
            'searchModeljabatan' => new RiwayatjabatanSearch(),

            'searchModelgaji' => new TransaksiPenggajianSearch(),

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

        if ($model->load(Yii::$app->request->post())) {
            if (!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))) {
                $ext = Yii::$app->tools->upload('MBiodata[foto]', Yii::getAlias('@uploads') . $model->nip . '/nip_' . $model->nip);
                $model->foto = $ext;
            }
            if (!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))) {
                $ext = Yii::$app->tools->upload('MBiodata[fotoNik]', Yii::getAlias('@uploads') . $model->nip . '/nik_' . $model->nik);
                $model->fotoNik = $ext;
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
        $oldFoto = $model->foto;
        $oldFotoNik = $model->fotoNik;
        if ($model->load(Yii::$app->request->post())) {
            if (!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))) {
                if (file_exists($filename = Yii::getAlias('@uploads') . $model->nip . '/' . $oldFoto) && !empty($oldFoto)) {
                    unlink($filename);
                }
                $ext = Yii::$app->tools->upload('MBiodata[foto]', Yii::getAlias('@uploads') . $model->nip . '/nip_' . $model->nip);
                $model->foto = $ext;
            } else {
                $model->foto = $oldFoto;
            }
            if (!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))) {
                if (file_exists($filename = Yii::getAlias('@uploads') . $model->nip . '/' . $oldFotoNik) && !empty($oldFotoNik)) {
                    unlink($filename);
                }
                $ext = Yii::$app->tools->upload('MBiodata[fotoNik]', Yii::getAlias('@uploads') . $model->nip . '/nik_' . $model->nik);
                $model->fotoNik = $ext;
            } else {
                $model->fotoNik = $oldFotoNik;
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
        $model = $this->findModel($id);
        if (file_exists($filename = Yii::getAlias('@uploads') . $model->nip . '/' . $model->foto) && !empty($model->foto)) {
            unlink($filename);
        }
        if (file_exists($filename = Yii::getAlias('@uploads') . $model->nip . '/' . $model->fotoNik) && !empty($model->fotoNik)) {
            unlink($filename);
        }
        $model->delete();

        return $this->redirect(['index']);
    }
    public function actionImport()
    {
        if (isset($_POST)) {
            if (!empty($_FILES)) {
                $tempFile = $_FILES['MBiodata']['tmp_name']['file'];
                $fileTypes = array('xls', 'xlsx'); // File extensions
                $fileParts = pathinfo($_FILES['MBiodata']['name']['file']);
                if (in_array(@$fileParts['extension'], $fileTypes)) {
                    if ($fileParts['extension'] == 'xlsx') {
                        $inputFileType = 'Xlsx';
                    } else {
                        $inputFileType = 'Xls';
                    }
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                    $spreadsheet = $reader->load($tempFile);
                    $worksheet = $spreadsheet->getActiveSheet();
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    //inilah looping untuk membaca cell dalam file excel,perkolom
                    $inserted = 0;
                    $errorCount = 0;
                    $totaldisetujui = 0;
                    for ($row = 2; $row <= $highestRow; ++$row) { //$row = 2 artinya baris kedua yang dibaca dulu(header kolom diskip disesuaikan saja)
                        $model2 = new MBiodata;
                        $model2->nip = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); //B
                        $model2->nama = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); //C
                        $model2->tempatLahir = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); //D
                        $model2->tanggalLahir = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); //E
                        $model2->alamat = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); //F
                        $model2->jenisKelamin = $worksheet->getCellByColumnAndRow(7, $row)->getValue(); //G
                        $model2->nik = $worksheet->getCellByColumnAndRow(8, $row)->getValue(); //G
                        $model2->golonganDarah = $worksheet->getCellByColumnAndRow(9, $row)->getValue(); //G
                        $model2->agama = $worksheet->getCellByColumnAndRow(10, $row)->getValue(); //G
                        $model2->gelarDepan = $worksheet->getCellByColumnAndRow(11, $row)->getValue(); //G
                        $model2->gelarBelakang = $worksheet->getCellByColumnAndRow(12, $row)->getValue(); //G
                        $model2->is_pegawai = 1;
                        try {
                            if ($model2->save(false)) {
                                $inserted++;
                            }
                        } catch (\yii\db\Exception $e) {
                            $errorCount++;
                            Yii::$app->session->setFlash('error', "($errorCount)Error saving model");
                        }
                    }
                    Yii::$app->session->setFlash('success', ($inserted) . ' row inserted');
                } else {
                    Yii::$app->session->setFlash('warning', "Wrong file type (xlsx, xls) only");
                }
            }
            $searchModel = new MBiodataSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination->pageSize = 10;
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
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
