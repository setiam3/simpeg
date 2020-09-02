<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use app\models\MUnit;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
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
