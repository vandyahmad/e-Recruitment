<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersDataEducation extends Model
{
    protected $table = 'users_data_education';

    protected $fillable = [
        'id',
        'user_id',
        'instansi_sd',
        'kota_sd',
        'tahun_mulai_sd',
        'tahun_selesai_sd',
        'instansi_smp',
        'kota_smp',
        'tahun_mulai_smp',
        'tahun_selesai_smp',
        'instansi_sma',
        'kota_sma',
        'tahun_mulai_sma',
        'tahun_selesai_sma',
        'jurusan_sma',
        'instansi_d3',
        'kota_d3',
        'tahun_mulai_d3',
        'tahun_selesai_d3',
        'jurusan_d3',
        'instansi_s1',
        'kota_s1',
        'tahun_mulai_s1',
        'tahun_selesai_s1',
        'jurusan_s1',
        'instansi_s2',
        'kota_s2',
        'tahun_mulai_s2',
        'tahun_selesai_s2',
        'jurusan_s2',
        'instansi_s3',
        'kota_s3',
        'tahun_mulai_s3',
        'tahun_selesai_s3',
        'jurusan_s3',
        'jenis_informal',
        'judul_informal',
        'penyelenggara_informal',
        'kota_informal',
        'durasi_informal',
        'tahun_informal',
        'informal_dibiayai_oleh',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
