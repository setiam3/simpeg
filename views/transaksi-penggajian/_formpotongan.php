<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use unclead\multipleinput\MultipleInput;

$this->registerJs(
    "
    function removeTr(el){
        var btn = $(el).attr('rel');
        $('#' + btn).remove();
    }
    function calculate(){
        $('#frmpotongan').each(function(){
        var potongan = 0;
        $(this).find('input[name*=\"potongan_nominal\"]').each(function(){
            potongan += parseInt($(this).val()); //<==== a catch  in here !! read below
        });
        gapok.potongan.push(potongan);
        });
    }
    "
);
$form = ActiveForm::begin();
echo $form->field($model, 'potong')->widget(MultipleInput::className(), [
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
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ]
    ]
 ]);
 ActiveForm::end();