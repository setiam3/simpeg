<?php

namespace app\widgets;

use app\models\MBiodata;
use app\models\MReferensi;
use app\models\Riwayatpendidikan;
use DateTime;
use yii\db\Expression;
use yii\db\Query;
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
  public function getSisaijin($iddata,$tglmulai,$tglakhir){

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
  public function nextPensiun()
  { // akan pensiun 1 jenis pegawai pns --kode pegawai pns  --kode pegawai 2 blud, 3 freelend --1 jenis pegawai pns
//      $sql = "SELECT * FROM m_biodata
//        WHERE date_part('YEAR', NOW()) - date_part('YEAR', 'tanggalLahir') IN ('59','60')
//          AND jenis_pegawai = '1'
//          AND is_pegawai = '1'
//          OR date_part('YEAR', NOW()) - date_part('YEAR', 'tanggalLahir') IN ('49','50')
//          AND jenis_pegawai IN ('3','2')
//          AND is_pegawai = '1'";

      $sql = "SELECT * FROM m_biodata
WHERE (EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM \"tanggalLahir\") IN (59,60))
AND (\"jenis_pegawai\" = 1)
AND (\"is_pegawai\" = '1')
or (EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM \"tanggalLahir\") IN (49,50))
AND (\"jenis_pegawai\" in ('3','2'))
AND (\"is_pegawai\" = '1')
";
//$where = new Expression('EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "tanggalLahir")');
//      $sql = MBiodata::find()
//          ->where(['=','is_pegawai','1'])
//          ->where(['in',$where,['59','60']])
//          ->where(['=','jenis_pegawai',1])
//          ->orWhere(['in',$where,['49','50']])
//          ->where(['in','jenis_pegawai',['3','2']])
//          ->all();
      return
//          $sql;
          $pensiun =  \Yii::$app->db->createCommand($sql)->queryAll();

  }

  public function getcurrentroleuser()
  {
    $currentrole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
    foreach ($currentrole as $roles) {
      $role[] = ['name' => $roles->name];
    }


    return ArrayHelper::map($role, 'name', 'name');
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
      $sql = MBiodata::find()
          ->select([
              'm_biodata.id_data',
              'r.id as id_rekening',
              'fotoNik',
              'foto',
              'r.fotoRekening',
              'p.dokumen as dokumen_pendidikan',
              'j.dokumen as dokumen_jabatan',
              'd.dokumen as dokumen_diklat',
              'k.dokumen as dokumen_kepangkatan'])
          ->Join('join', 'm_rekening as r','m_biodata.id_data = r.id_data')
          ->joinWith('riwayatdiklats as d')
          ->joinWith('riwayatjabatans as j')
          ->joinWith('riwayatpendidikans as p')
          ->joinWith('riwayatpendidikans as p')
          ->joinWith('kepangkatans as k')
          ->where(['is_pegawai' => '1'])
          ->where(['m_biodata.id_data' => '2'])
          ->all();

    return $sql;
  }

  public function str(){
      $role = \Yii::$app->tools->getcurrentroleuser();
      if (in_array('karyawan', $role)) {
          $where_iddata = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
      } else {
          $where_iddata = '';
      }
      $where = new Expression('EXTRACT(MONTH FROM tgl_berlaku_ijin) ::INTEGER - 1 = EXTRACT(MONTH	FROM NOW()) ::INTEGER');
      $tahun = new Expression('EXTRACT(YEAR FROM tgl_berlaku_ijin) ::INTEGER = EXTRACT(YEAR FROM NOW()) ::INTEGER');
      $data = Riwayatpendidikan::find()
//          ->join('join','m_biodata','riwayatpendidikan.id_data = m_biodata.id_data')
          ->joinWith('data')
          ->where(['is not','tgl_berlaku_ijin',null])
          ->andWhere($where)
          ->andWhere($tahun)
          ->andWhere(['like','suratijin','STR'])
          ->andWhere($where_iddata)
          ->all();
      return $data;
  }

    public function sip(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where_iddata = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $where_iddata = '';
        }
        $where = new Expression('EXTRACT(MONTH FROM tgl_berlaku_ijin) ::INTEGER - 1 = EXTRACT(MONTH	FROM NOW()) ::INTEGER');
        $tahun = new Expression('EXTRACT(YEAR FROM tgl_berlaku_ijin) ::INTEGER = EXTRACT(YEAR FROM NOW()) ::INTEGER');
        $data = Riwayatpendidikan::find()
//            ->select('m_biodata.nama, tgl_berlaku_ijin')
//            ->join('join','m_biodata','riwayatpendidikan.id_data = m_biodata.id_data')
            ->joinWith('data')
            ->where(['is not','tgl_berlaku_ijin',null])
            ->andWhere($where)
            ->andWhere(['like','suratijin','SIP'])
            ->andWhere($where_iddata)
            ->andWhere($tahun)
            ->all();
        return $data;
    }

    public function kategori(){

      $datas = MReferensi::find()->select('nama_referensi')->where(['tipe_referensi'=>'6'])->createCommand()
          ->queryAll();
      return $datas;
    }

}
