<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'employee';

    protected $fillable = ['nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'email', 'no_hp', 'pendidikan_terakhir', 'minat_karir', 'upload_foto', 'name'];

    protected $guarded = [];
}
