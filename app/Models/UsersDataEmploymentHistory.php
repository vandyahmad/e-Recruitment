<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersDataEmploymentHistory extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'users_data_employment_history';

    protected $fillable = [
        'id',
        'user_id',
        'nama_perusahaan',
        'jabatan',
        'divisi',
        'nama_atasan',
        'jabatan_atasan',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
