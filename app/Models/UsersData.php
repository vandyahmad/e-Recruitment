<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersData extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'users_data';

    protected $fillable = ['id', 'user_id', 'nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir','agama', 'alamat', 'email', 'no_hp', 'pendidikan_terakhir', 'jurusan', 'institusi', 'nilai', 'upload_foto','upload_file', 'name'];

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
}
