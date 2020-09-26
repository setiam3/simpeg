<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\models\MReferensi;
$this->registerJs("

");
?>

<div class="pinjaman-form">
    <?php 
    $form = ActiveForm::begin(); 
    echo '<table><tr>
        <th>Jenis</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
    </tr>';
    foreach($model as $k=>$v){
        echo '<tr id="'.$v->id.'">
            <td>'.$form->field($v,"[$v->id]".'jenis')->dropDownList(
                ArrayHelper::map(MReferensi::find()->where(['tipe_referensi'=>11,'status'=>'1'])->all()
                    ,'reff_id','nama_referensi'),
                ['options' => [$v->jenis=> ['Selected'=>'selected']]]
            )->label(false).'</td>
            <td>'.$form->field($v,"[$v->id]".'tanggal')->label(false).'</td>
            <td>'.$form->field($v,"[$v->id]".'namaBarang')->label(false).'</td>
            <td>'.$form->field($v,"[$v->id]".'jumlah')->label(false).'</td>
        </tr>';
    }
    echo '</table>';
    ?>
</div>
