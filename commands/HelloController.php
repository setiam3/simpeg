<?php
namespace app\commands;
use app\models\MUnit;
use yii\console\Controller;
use yii\console\ExitCode;
class HelloController extends Controller
{
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }
    public function actionGenjatahcuti($tahun){
        $data=\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->andWhere(['in','jenis_pegawai',[1,2,3]])->all();
        foreach($data as $d){
            if(!(\app\models\Jatahcuti::updateAll(['sisa'=>12],['id_data'=>$d->id_data]))){
            $jt=new \app\models\Jatahcuti();
            $jt->sisa=12;
            $jt->id_data=$d->id_data;
            $jt->save();
            }
        }

    }
    public function actionTransfermsunit(){
        $start_time = microtime(true);
        $col=((new MUnit)->getTableSchema()->getColumnNames());
        //$col=array_diff($col,array('id',''));
        $result=\Yii::$app->db_live->createCommand("select * from m_unit")->queryAll();
        if(\Yii::$app->db->createCommand()->batchInsert('m_unit',$col,$result)->execute()){
            return true;
            echo 'transfer sukses';
        }else{
            return false;
            echo 'transfer gagal';
        }
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time)/60;
        echo $execution_time."\n";
        return ExitCode::OK;
    }
}
