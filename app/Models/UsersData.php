<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersData extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'users_data';

    protected $fillable = [
        'id',
        'user_id',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        // 'alamat',
        'pref_location',
        'email',
        'no_hp',
        'pendidikan_terakhir',
        'jurusan',
        'institusi',
        'nilai',
        'upload_foto',
        'upload_file',
        'form_interview',
        'info_lowongan',
        'nama_panggilan',
        'tinggi_badan',
        'berat_badan',
        'status_kawin',
        'warga_negara',
        'jalan_ktp',
        'no_rumah_ktp',
        'rt_ktp',
        'rw_ktp',
        'kel_ktp',
        'kec_ktp',
        'kota_ktp',
        'prov_ktp',
        'kode_pos_ktp',
        'sama_dengan_ktp',
        'jalan_domisili',
        'no_rumah_domisili',
        'rt_domisili',
        'rw_domisili',
        'kel_domisili',
        'kec_domisili',
        'kota_domisili',
        'prov_domisili',
        'kode_pos_domisili',
        'sim_a',
        'sim_b',
        'sim_c',
        'tempat_tinggal',
        'kendaraan',
        'hobi',
        'kemampuan_english',
        'kemampuan_komputer',
        'kemampuan_khusus',
        'aktifitas_sosial',
        'riwayat_sakit',
        'nama_emergency',
        'no_hp_emergency',
        'hubungan_emergency',
    ];

    protected $guarded = [];

    // public function activities()
    // {
    //     return $this->hasMany(PelamarActivity::class, 'id_pelamar', 'id');
    //     // return $this->hasMany(PelamarActivity::class);
    // }

    public function pelamars()
    {
        return $this->hasMany(pelamars::class, 'user_id', 'user_id');
    }

    // public function job_vacancy()
    // {
    //     return $this->belongsTo(JobVacancies::class, 'minat_karir', 'id');
    // }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
}
