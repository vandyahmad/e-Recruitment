<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeFamily extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'employee_family';

    protected $fillable = [
        'id',
        'employee_id',
        'hubungan_fam',
        'nama_fam',
        'usia_fam',
        'jenis_kelamin_fam',
        'pendidikan_terakhir_fam',
        'pekerjaan_fam',
        'perusahaan_tempat_kerja_fam',
        'alamat_fam',
        // 'nik_fam',
        // 'tempat_lahir_fam',
        // 'tanggal_lahir_fam',
        // 'emergency_contact',
    ];

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
