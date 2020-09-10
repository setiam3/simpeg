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
            $link = \Yii::getAlias('@web/uploads/foto/avatarfemale.jpg');
            echo Html::a(Html::img($link, ['class' => 'col-xs-12']), $link, ['class' => '']);
        } ?>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'th-right table table-striped table-bordered detail-view'],
            'attributes' => [
                [
                    'attribute' => 'nama',
                    'value' => function ($model) {
                        return $model->gelarDepan . ' ' . $model->nama . ' ' . $model->gelarBelakang;
                    }
                ],
                'nip',
                [
                    'label' => 'TTL',
                    'value' => function ($model) {
                        return $model->tempatLahir . ', ' . $model->tanggalLahir;
                    }
                ],
                [
                    'label' => 'Usia',
                    'value' => function ($model) {
                        return \Yii::$app->tools->getUsia($model->tanggalLahir);
                    }
                ],
                [
                    'attribute' => 'jenisKelamin',
                    'value' => function ($model) {
                        return $model->sex->nama_referensi;
                    }
                ],
                [
                    'attribute' => 'agama',
                    'value' => function ($model) {
                        return $model->agamanya->nama_referensi;
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
                    'content' => $this->renderAjax('//biodata/view', ['model' => $model]),
                    'active' => true,
                ],
                [
                    'label' => 'Jabatan',
                    'content' => $this->render('//riwayatjabatan/index', [
                        'searchModel' => $searchModeljabatan,
                        'dataProvider' => $searchModeljabatan->search(Yii::$app->request->queryParams, ['m_biodata.id_data' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Gaji',
                    'content' => $this->render('//transaksi-penggajian/index', [
                        'searchModel' => $searchModelgaji,
                        'dataProvider' => $searchModelgaji->search(Yii::$app->request->queryParams, ['data_id' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Keluarga',
                    'content' => $this->render('//keluarga/index', [
                        'searchModel' => $searchModelKeluarga,
                        'dataProvider' => $searchModelKeluarga->search(Yii::$app->request->queryParams, ['parent_id' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Diklat',
                    'content' => $this->render('//riwayatdiklat/index', [
                        'searchModel' => $searchModeldiklat,
                        'dataProvider' => $searchModeldiklat->search(Yii::$app->request->queryParams, ['m_biodata.id_data' => $model->id_data])
                    ]),
                ],
                [
                    'label' => 'Pendidikan',
                    'content' => $this->render('//riwayatpendidikan/index', [
                        'searchModel' => $searchModelpendidikan,
                        'dataProvider' => $searchModelpendidikan->search(Yii::$app->request->queryParams, ['id_data' => $model->id_data])
                    ]),
                ],
            ],
        ]);
        $this->title = "My Profile";
        ?>
    </div>
</div>