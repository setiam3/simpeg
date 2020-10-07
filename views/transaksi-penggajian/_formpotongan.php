<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use unclead\multipleinput\MultipleInput;

$this->registerJs(
    "
    function calculate(){
        $('.multiple-input-list').each(function(){
        var potongan = 0;
        $(this).find('input[name*=\"potongan_nominal\"]').each(function(){
            potongan += parseInt($(this).val());
        });
        gapok.potongan.push(potongan);
        });
        gajinetto();
    }
    "
);
$form = ActiveForm::begin();
echo $form->field($model, 'potong')->widget(MultipleInput::className(), [
    'data'=>$model->isNewRecord?'':$potongangaji,
    'columns' => [
        [
            'name'  => 'potongan_desc',
            'type'  => kartik\typeahead\Typeahead::className(),
            'title' => 'Potongan Desc',
            'options'=>[
                'pluginOptions'=>['highlight'=>true],
                'dataset'=>[
                    [
                        'remote' => [
                            'url' => Url::to(['referensi/getpotongandesc']) . '?q=%QUERY',
                            'wildcard' => '%QUERY'
                        ]
                    ]
                ],
            ],
        ],
        [
            'name'  => 'potongan_nominal',
            'title' => 'Nominal',
            'defaultValue'=>0,
            'enableError' => true,
            'options' => [
                'class' => 'input-priority',
                'onkeyup'=>'calculate()',
            ]
        ]
    ]
 ])->label(false);
 ActiveForm::end();