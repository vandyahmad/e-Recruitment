<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'employee';

    protected $fillable = [
        'user_id',
        'company_code',
        'nik',
        'nip',
        'nama_lengkap',
        'jabatan',
        'tanggal_mulai_kerja',
        'tanggal_selesai_kerja',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_kawin',
        'status_ptkp',
        'agama',
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
        'email',
        'no_hp',
        'gol_darah',
        'no_kk',
        'no_npwp',
        'no_bpjs_kesehatan',
        'no_bpjs_ketenagakerjaan',
        'sim_a',
        'sim_b',
        'sim_c',
        'nama_bank',
        'no_rekening',
        'nama_rekening',
        'status_karyawan',
        'pendidikan_terakhir',
        'jurusan',
        'institusi',
        'nilai',
        'upload_foto',
        'upload_file'
    ];

    protected $guarded = [];

    public function family()
    {
        return $this->hasMany(EmployeeFamily::class, 'employee_id', 'id');
    }

    public function document()
    {
        return $this->hasMany(EmployeeDocument::class, 'employee_id', 'id');
    }
}
