<?php

namespace app\widgets;

use app\models\MBiodata;
use DateTime;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use tpmanc\imagick\Imagick;
use yii\helpers\ArrayHelper;

class Tools extends \yii\bootstrap\Widget
{

  public function init()
  {
    parent::init();
  }
  public function upload($instancename, $path)
  {
    $file = UploadedFile::getInstanceByName($instancename);
    $ext = substr($file->name, strrpos($file->name, '.') + 1);
    $path .= '_' . time();
    $exploded = explode('/', $path);
    $dir = trim($path, end($exploded));
    if (!file_exists($dir) && !is_dir($dir)) {
      FileHelper::createDirectory($dir, $mode = 0775, $recursive = true);
    }
    $file->saveAs($path . '.' . $ext);
    $explodeNamafile = explode('/', $path);
    $namafile = end($explodeNamafile) . '.' . $ext;
    return $namafile;
  }
  public function pdftoimg($pathfile)
  {
    $preview = '';
    $ext = pathinfo($pathfile);
    $image = ['jpg', 'jpeg', 'png'];

    if ($ext['extension'] == 'pdf') {
      $this->genPdfThumbnail($pathfile, $ext['basename'] . '.jpeg');
      $preview = \Yii::getAlias('@web/uploads/foto/510204244/') . $ext['basename'] . '.jpeg';
    } elseif (in_array(strtolower($ext['extension']), $image)) {
    } else {
      $preview = '';
    }
    return $preview;
  }

  public function genPdfThumbnail($source, $target)
  {
    $target = dirname($source) . DIRECTORY_SEPARATOR . $target;
    $im     = new Imagick($source); // 0-first page, 1-second page
    $im->setImageColorspace(255); // prevent image colors from inverting
    $im->setimageformat("jpeg");
    $im->thumbnailimage(160, 160); // width and height
    $im->writeimage($target);
    $im->clear();
    $im->destroy();
  }

  public function getUsia($date)
  {

    $datetime1 = new DateTime($date);

    $datetime2 = new DateTime();

    $diff = $datetime1->diff($datetime2);

    return $diff->y . " tahun " . $diff->m . " bulan " . $diff->d . " hari";
  }
  public function listIcon($typeicons)
  {
    $icon = [];
    if ($typeicons == 'glyphicon') {
      $path = \Yii::getAlias('@vendor/bower-asset/bootstrap/docs/_data/glyphicons.yml');
      $array = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($path));
      foreach ($array as $k => $value) {
        $icon[] = ['key' => $k, 'value' => $typeicons . ' ' . $value];
      }
    } else {
      //$path=\Yii::getAlias('@webroot/css/fa-4.7.0.yml');
      $path = \Yii::getAlias('@webroot/css/icons.yml');
      $array = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($path));

      foreach ($array as $k => $value) {
        $icon[] = ['key' => $k, 'value' => $typeicons . $k];
      }
    }


    return $icon;
  }


  public function grafikPopulasi()
  { // L/P
    return \app\models\MBiodata::find()
      ->select('nama_referensi,count("jenisKelamin") as jumlah')
      ->joinWith('sex')
      ->where(['tipe_referensi' => 8, 'status' => '1'])
      ->groupBy("nama_referensi,jenisKelamin")
      ->createCommand()->queryAll();
  }
  public function gjenisPegawai()
  { //pns / non /
    return \app\models\MBiodata::find()
      ->select('nama_referensi,count("jenis_pegawai") as jumlah')
      ->joinWith('jenispegawai')
      ->where(['tipe_referensi' => 1])
      ->groupBy("nama_referensi,jenis_pegawai")
      ->createCommand()->queryAll();
  }
  public function golonganPegawai()
  { // bar, gol 1 2 3
    return MBiodata::find()
      ->select('nama_referensi,count(nama_referensi) as jumlah')
      ->joinWith(['kepangkatans' => function ($query) {
        $query->joinWith(['penggolongangaji' => function ($query) {
          $query->joinWith('jenisPegawai');
        }]);
      }])
      //            ->joinWith('penggolongangaji')
      //            ->joinWith('jenisPegawai')
      ->groupBy("nama_referensi")
      ->createCommand()
      ->queryAll();
  }

  public function ultahPegawai()
  { // month year
    $sql = 'SELECT * FROM m_biodata 
WHERE EXTRACT(month FROM "tanggalLahir") :: INTEGER = EXTRACT(month FROM NOW()) ::INTEGER 
AND EXTRACT(DAY FROM "tanggalLahir") :: INTEGER >= EXTRACT(DAY FROM NOW())::INTEGER';

    return $hasil = \Yii::$app->db->createCommand($sql)->queryAll();
  }
  public function nextPensiun($y)
  { // akan pensiun


  }
  public function getcurrentroleuser()
  {
    $currentrole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
    foreach ($currentrole as $roles) {
      $role[] = ['name' => $roles->name];
    }

      return ArrayHelper::map($role,'name','name');
  }


  protected function findModelAll($condition, $models)
  {
    $modelx = \Yii::createObject([
      'class' => "app\models\\" . $models,
    ]);
    if (($model = $modelx::findAll($condition)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
  public function getNotifdokumen()
  {
    $sql = 'SELECT COUNT(*) as jumlah 
      FROM m_biodata as b
      join m_rekening as r on b.id_data = r.id_data
      JOIN riwayatdiklat as rd on b.id_data = rd.id_data
      JOIN riwayatpendidikan as rp on b.id_data = rp.id_data
      JOIN kepangkatan as ke on b.id_data = ke.id_data
      WHERE foto is NULL or "fotoNik" IS NULL or "fotoRekening" is NULL or "fotoNpwp" is NULL or rd.dokumen IS NULL or rp.dokumen is NULL or ke.dokumen is NULL';

    return $hasil = \Yii::$app->db->createCommand($sql)->queryAll();
  }

}
