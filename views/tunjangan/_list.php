<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\models\MReferensi;
$this->registerJs("

");
?>

<div class="mtunjangan-form">
    <?php 
    $form = ActiveForm::begin(); 
    echo '<table><tr>
        <th>Tunjangan</th>
        <th>Nominal</th>
        <th>Status</th>
    </tr>';
    foreach($model as $k=>$v){
        echo '<tr id="'.$v->id.'">
            <td>'.$form->field($v,"[$v->id]".'tunjangan_id')->dropDownList(
                ArrayHelper::map(MReferensi::find()->where(['tipe_referensi'=>4,'status'=>'1'])->all()
                    ,'reff_id','nama_referensi'),
                ['options' => [$v->tunjangan_id=> ['Selected'=>'selected']]]
            )->label(false).'</td>
            <td>'.$form->field($v,"[$v->id]".'nominal')->label(false).'</td>
            <td>'.$form->field($v,"[$v->id]".'status')->dropDownList(
                ArrayHelper::map([['id'=>'1','value'=>'aktif'],['id'=>'0','value'=>'nonaktif']],'id','value')
            )->label(false).'</td>
        </tr>';
    }
    echo '</table>';
    ?>
</div>
