<?php 
namespace app\widgets;
use DateTime;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class Tools extends \yii\bootstrap\Widget{

    public function init(){
        parent::init();   
    }
    public function upload($instancename,$path){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $file=UploadedFile::getInstanceByName($instancename);
      $ext=substr($file->name, strrpos($file->name, '.')+1);
      $exploded = explode('/', $path);
      $dir=trim($path,end($exploded));
      if(!file_exists($dir) && !is_dir($dir)){
        FileHelper::createDirectory($dir, $mode = 0775, $recursive = true);
      }
      $file->saveAs($path.'.'.$ext);
      return $ext;
    }
    
    public function getUsia($date){

      $datetime1 = new DateTime($date);

      $datetime2 = new DateTime();

      $diff = $datetime1->diff($datetime2);

      return $diff->y." tahun " . $diff->m . " bulan " . $diff->d . " hari";
    }
    public function listIcon($typeicons){
      $icon=[];
      if($typeicons=='glyphicon'){
        $path=\Yii::getAlias('@vendor/bower-asset/bootstrap/docs/_data/glyphicons.yml');
        $array = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($path));
        foreach ($array as $k=>$value) {
            $icon[]=['key'=>$k,'value'=>$typeicons.' '.$value];
        }
      }else{
        //$path=\Yii::getAlias('@webroot/css/fa-4.7.0.yml');
        $path=\Yii::getAlias('@webroot/css/icons.yml');
        $array = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($path));

        foreach ($array as $k=>$value) {
            $icon[]=['key'=>$k,'value'=>$typeicons.$k];
        }
      }
      
      return $icon;
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