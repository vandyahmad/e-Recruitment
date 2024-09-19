<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'employee_document';

    protected $fillable = [
        'id',
        'employee_id',
        'doc_ktp',
        'doc_npwp',
        'doc_kk',
        'doc_sim',
        'doc_buku_rekening',
        'doc_ijazah_terakhir',
        'doc_transkrip_nilai',
        'doc_paklaring',
        'doc_bpjs_kesehatan',
        'doc_bpjs_ketenagakerjaan',
        'doc_surat_nikah',
        'doc_surat_vaksin',
        'doc_akta_kelahiran_anak_1',
        'doc_akta_kelahiran_anak_2',
        'doc_akta_kelahiran_anak_3',
    ];

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
