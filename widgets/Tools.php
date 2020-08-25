<?php 
namespace app\widgets;
use DateTime;
class Tools extends \yii\bootstrap\Widget{

    public function init(){
        parent::init();   
    }
    
    public function getUsia($date){

      $datetime1 = new DateTime($date);

      $datetime2 = new DateTime();

      $diff = $datetime1->diff($datetime2);

      return $diff->y." tahun " . $diff->m . " bulan " . $diff->d . " hari";
    }

    public function grafikPopulasi(){// L/P

    }
    public function gjenisPegawai(){//pns / non
      
    }
    public function golonganPegawai(){// bar, gol 1 2 3 
      
    }
    public function ultahPegawai($my){// month year
      return $model=\app\models\VPegawai::find()->where(['month(tanggalLahir)'=>$my])->all();
    }
    public function nextPensiun($y){// akan pensiun
      
    }
    protected function findModelAll($condition,$models){
        $modelx=\Yii::createObject([
          'class' => "app\models\\".$models,
         ]);
        if (($model = $modelx::findAll($condition)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
?>