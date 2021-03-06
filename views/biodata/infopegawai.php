<?php

use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-3">
        <?php $linkFoto = \Yii::getAlias('@web/uploads/foto/' . $model->nip . '/' . $model->foto);
        if (file_exists(\Yii::getAlias('@uploads') . $model->nip . '/' . $model->foto) && !empty($model->foto)) {
            echo Html::a(Html::img($linkFoto, ['class' => 'col-xs-12']), $linkFoto, ['class' => '']);
        } else {
            $link = ($model->jenisKelamin==10)?\Yii::getAlias('@web/uploads/foto/avatarfemale.jpg'):\Yii::getAlias('@web/uploads/foto/avatar-male.jpg');
            echo Html::a(Html::img($link, ['class' => 'col-xs-12']), $link, ['class' => '']);
        } ?>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'th-right table table-striped table-bordered detail-view'],
            'attributes' => [
                [
                    'attribute' => 'nama',
                    'value' => function ($data) {
                        return $data->gelarDepan . ' ' . $data->nama . ' ' . $data->gelarBelakang;
                    }
                ],
                'nip',
                [
                    'label' => 'TTL',
                    'value' => function ($data) {
                        return $data->tempatLahir . ', ' . $data->tanggalLahir;
                    }
                ],
                [
                    'label' => 'Usia',
                    'value' => function ($data) {
                        return \Yii::$app->tools->getUsia($data->tanggalLahir);
                    }
                ],
                [
                    'attribute' => 'jenisKelamin',
                    'value' => function ($data) {
                        return $data->sex->nama_referensi;
                    }
                ],
                [
                    'attribute' => 'agama',
                    'value' => function ($data) {
                        return $data->agamanya->nama_referensi;
                    }
                ],
            ],
        ]);
        ?>
    </div>

    <div class="col-md-9">
        <?php
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Biodata',
                    'content' => $this->renderAjax('view', ['model' => $model]),
                    'active' => true,
                ],
                [
                    'label' => 'Jabatan',
                    'content' => $this->render('//riwayatjabatan/index', [
                        'searchModel' => $searchModeljabatan,
                        'klikedid' => $model->id_data,
                        'dataProvider' => $searchModeljabatan->search(Yii::$app->request->queryParams, ['riwayatjabatan.id_data' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Pangkat',
                    'content' => $this->render('//kepangkatan/index', [
                        'searchModel' => $searchModelpangkat,
                        'klikedid' => $model->id_data,
                        'dataProvider' => $searchModelpangkat->search(Yii::$app->request->queryParams, ['kepangkatan.id_data' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Gaji',
                    'content' => $this->render('//transaksi-penggajian/index', [
                        'searchModel' => $searchModelgaji,
                        'klikedid' => $model->id_data,
                        'dataProvider' => $searchModelgaji->search(Yii::$app->request->queryParams, ['data_id' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Keluarga',
                    'content' => $this->render('//keluarga/index', [
                        'searchModel' => $searchModelKeluarga,
                        'klikedid' => $model->id_data,
                        'dataProvider' => $searchModelKeluarga->search(Yii::$app->request->queryParams, ['parent_id' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Diklat',
                    'content' => $this->render('//riwayatdiklat/index', [
                        'searchModel' => $searchModeldiklat,
                        'klikedid' => $model->id_data,
                        'dataProvider' => $searchModeldiklat->search(Yii::$app->request->queryParams, ['m_biodata.id_data' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Pendidikan',
                    'content' => $this->render('//riwayatpendidikan/index', [
                        'searchModel' => $searchModelpendidikan,
                        'klikedid' => $model->id_data,
                        'dataProvider' => $searchModelpendidikan->search(Yii::$app->request->queryParams, ['riwayatpendidikan.id_data' => $model->id_data])
                    ]),
                ],
            ],
        ]);
        $this->title = "Biodata Pegawai";
        $this->params['breadcrumbs'][] = '';
        ?>
    </div>
</div>
