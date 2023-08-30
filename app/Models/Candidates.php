<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'candidates';

    protected $fillable =   [
                            'nik',
                            'nama_lengkap',
                            'nama_panggilan',
                            'tempat_lahir',
                            'tanggal_lahir',
                            'jenis_kelamin',
                            'agama',
                            'kewarganegaraan',
                            'status_kawin',
                            'tinggi_badan',
                            'berat_badan',
                            'hobi',
                            'upload_foto',
                            'upload_file'
                            ];

    protected $guarded = [];
}
