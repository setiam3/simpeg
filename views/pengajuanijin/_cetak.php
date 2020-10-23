<?php

echo 'Gresik, '.Yii::$app->formatter->asDate($model->tanggalPengajuan,'long');
echo $model->data->namalengkap;
echo $model->data->alamat;
echo $model->data->telp;
echo $model->data->riwayatjabatan->jabatan->nama_referensi;
echo $model->data->riwayatjabatan->unitKerja->unit;
echo $model->data->nip;
echo $model->jenisIjin;
echo $model->alasan;
echo $model->tanggalMulai;
echo $model->tanggalAkhir;
$endDate = strtotime($model->tanggalAkhir);
$startDate = strtotime($model->tanggalMulai);
$days = ($endDate - $startDate) / 86400 + 1;
echo 'lama cuti : '.$days;
echo $model->approval10->namalengkap;
echo $model->approval10->nip;
echo $model->approval20->namalengkap;
echo $model->approval20->nip;
echo $model->disetujui;
echo $model->keterangan;
echo $model->data->sisacuti->sisa;