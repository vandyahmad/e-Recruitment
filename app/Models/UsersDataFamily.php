<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersDataFamily extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'users_data_family';

    protected $fillable = [
        'id',
        'user_id',
        'hubungan',
        'nama',
        'jenis_kelamin',
        'usia',
        'pendidikan_terakhir',
        'pekerjaan',
        'perusahaan_tempat_kerja',
        'alamat',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
