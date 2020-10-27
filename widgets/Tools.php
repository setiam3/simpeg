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
use app\models\Pengajuanijin;

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
  function getWorkingDays($startDate, $endDate, $holidays)
  {
    $endDate = strtotime($endDate);
    $startDate = strtotime($startDate);
    $days = ($endDate - $startDate) / 86400 + 1;
    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);
    $the_first_day_of_week = date("N", $startDate);
    $the_last_day_of_week = date("N", $endDate);
    if ($the_first_day_of_week <= $the_last_day_of_week) {
      //if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
      if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    } else {
      if ($the_first_day_of_week == 7) {
        $no_remaining_days--;
        // if ($the_last_day_of_week == 6) {
        //     // if the end date is a Saturday, then we subtract another day
        //     $no_remaining_days--;
        // }
      } else {
        $no_remaining_days -= 1;
      }
    }
    $workingDays = $no_full_weeks * 6; //6hari kerja
    if ($no_remaining_days > 0) {
      $workingDays += $no_remaining_days;
    }
    foreach ($holidays as $holiday) {
      $time_stamp = strtotime($holiday);
      if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 7 && date("N", $time_stamp) != 7)
        $workingDays--;
    }

    return $workingDays;
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
          $query->joinWith('pangkat');
        }]);
      }])->where(['!=', 'nama_referensi', ''])
      ->groupBy("nama_referensi")
      ->createCommand()
      ->queryAll();
  }

  public function ultahPegawai()
  { // month year
    $namalengkap = new Expression('concat("gelarDepan",nama,"gelarBelakang") as nama');
    $sql = 'SELECT ' . $namalengkap . ',"tanggalLahir" FROM m_biodata
  WHERE EXTRACT(month FROM "tanggalLahir") :: INTEGER = EXTRACT(month FROM NOW()) ::INTEGER
  AND EXTRACT(DAY FROM "tanggalLahir") :: INTEGER >= EXTRACT(DAY FROM NOW())::INTEGER';

    return $hasil = \Yii::$app->db->createCommand($sql)->queryAll();
  }
  public function nextPensiun()
  { // akan pensiun 1 jenis pegawai pns --kode pegawai pns  --kode pegawai 2 blud, 3 freelend --1 jenis pegawai pns
    $usia = new Expression('EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "tanggalLahir")');
    $namalengkap = new Expression('concat("gelarDepan",nama,"gelarBelakang") as nama');
    $sql = "SELECT $namalengkap,\"tanggalLahir\" FROM m_biodata
    WHERE ( $usia IN (59,60))
    AND (\"jenis_pegawai\" = '1')
    AND (\"is_pegawai\" = '1')
    or ($usia IN (49,50))
    AND (\"jenis_pegawai\" in ('3','2'))
    AND (\"is_pegawai\" = '1')";
    return $pensiun =  \Yii::$app->db->createCommand($sql)->queryAll();
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
    return MBiodata::find()
      ->select([
        'm_biodata.id_data',
        'r.id as id_rekening',
        'fotoNik',
        'foto',
        'r.fotoRekening',
        'p.dokumen as dokumen_pendidikan',
        'j.dokumen as dokumen_jabatan',
        'd.dokumen as dokumen_diklat',
        'k.dokumen as dokumen_kepangkatan'
      ])
      ->Join('join', 'm_rekening as r', 'm_biodata.id_data = r.id_data')
      ->joinWith('riwayatdiklats as d')
      ->joinWith('riwayatjabatans as j')
      ->joinWith('riwayatpendidikans as p')
      ->joinWith('riwayatpendidikans as p')
      ->joinWith('kepangkatans as k')
      ->where(['is_pegawai' => '1'])
      ->where(['m_biodata.id_data' => '2'])
      ->all();
  }

  public function str()
  {
    $role = \Yii::$app->tools->getcurrentroleuser();
    if (in_array('karyawan', $role)) {
      $where_iddata = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
    } else {
      $where_iddata = '';
    }
    $where = new Expression('EXTRACT(MONTH FROM tgl_akhir_ijin) ::INTEGER - 1 = EXTRACT(MONTH	FROM NOW()) ::INTEGER');
    $tahun = new Expression('EXTRACT(YEAR FROM tgl_akhir_ijin) ::INTEGER = EXTRACT(YEAR FROM NOW()) ::INTEGER');
    $data = Riwayatpendidikan::find()
      ->joinWith('data')
      ->where(['is not', 'tgl_akhir_ijin', null])
      ->andWhere($where)
      ->andWhere($tahun)
      ->andWhere(['like', 'suratijin', 'STR'])
      ->andWhere($where_iddata)
      ->all();
    return $data;
  }


  public function sip()
  {
    $role = \Yii::$app->tools->getcurrentroleuser();
    if (in_array('karyawan', $role)) {
      $where_iddata = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
    } else {
      $where_iddata = '';
    }
    $where = new Expression('EXTRACT(MONTH FROM tgl_akhir_ijin) ::INTEGER - 1 = EXTRACT(MONTH	FROM NOW()) ::INTEGER');
    $tahun = new Expression('EXTRACT(YEAR FROM tgl_akhir_ijin) ::INTEGER = EXTRACT(YEAR FROM NOW()) ::INTEGER');
    $data = Riwayatpendidikan::find()
      ->joinWith('data')
      ->where(['is not', 'tgl_akhir_ijin', null])
      ->andWhere($where)
      ->andWhere(['like', 'suratijin', 'SIP'])
      ->andWhere($where_iddata)
      ->andWhere($tahun)
      ->all();
    return $data;
  }
  public function kategori()
  {
    $kategori = [];
    $cat = MReferensi::find()->select('nama_referensi')->where(['tipe_referensi' => '6'])->createCommand()
      ->queryAll();
    if (empty($cat)) {
      $kategori[] = '';
    } else {
      foreach ($cat as $row) {
        $kategori[] = $row['nama_referensi'];
      }
    }
    return sort($kategori);
  }
  public function dataIzin()
  {
    $role = \Yii::$app->tools->getcurrentroleuser();
    if (in_array('karyawan', $role) && in_array('approval1', $role)) {
      $where_iddata = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
      $where = 'approval1 is null AND unit_kerja = (SELECT unit_kerja from m_biodata as b JOIN riwayatjabatan as rj on b.id_data = rj.id_data WHERE b.id_data =' . \Yii::$app->user->identity->id_data . ')';
      $izin = Pengajuanijin::find()
        ->joinWith(['data' => function ($query) {
          $query->joinWith('riwayatjabatans');
        }])
        ->where($where_iddata)
        ->orWhere($where)
        ->all();
    } elseif (in_array('approval1', $role)) {
      $where = 'approval1 is null AND unit_kerja = (SELECT unit_kerja from m_biodata as b JOIN riwayatjabatan as rj on b.id_data = rj.id_data WHERE b.id_data =' . \Yii::$app->user->identity->id_data . ')';
      $izin = Pengajuanijin::find()
        ->joinWith('data')
        ->andWhere($where)
        ->all();
    } elseif (in_array('approval2', $role)) {
      $where = 'approval1 != 0 and approval2 IS NULL ';
      $izin = Pengajuanijin::find()
        ->joinWith('data')
        ->where($where)
        ->all();
    } elseif (in_array('karyawan', $role)) {
      $where_iddata = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
      $izin = Pengajuanijin::find()
        ->joinWith('data')
        ->andWhere($where_iddata)
        ->all();
    } else {
      $izin = Pengajuanijin::find()
        ->joinWith('data')
        ->all();
    }
    if ($izin !== null) {
      return $izin;
    }
  }
}
