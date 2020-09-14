<?php
namespace app\controllers;
use app\models\PengajuanijinSearch;
use Yii;
use app\models\UserSearch;
use app\models\MBiodata;
use app\models\MKeluargaSearch;
use app\models\RiwayatpendidikanSearch;
use app\models\RiwayatdiklatSearch;
use app\models\RiwayatjabatanSearch;
use app\models\TransaksiPenggajianSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $identity = Yii::$app->user->identity;
        $model=$this->findModel($identity->id_data);
        return $this->render('index',[
            'model' => $model,
            'searchModelKeluarga' => new MKeluargaSearch(),
            'searchModelpendidikan' => new RiwayatpendidikanSearch(),
            'searchModeldiklat' => new RiwayatdiklatSearch(),
            'searchModeljabatan' => new RiwayatjabatanSearch(),
            'searchModelgaji' => new TransaksiPenggajianSearch(),
            'searchModelpengajuanijin' => new PengajuanijinSearch(),
        ]);
    }
    public function actionUpdate(){
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
    public function findModel($id){
        if (($model = MBiodata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
