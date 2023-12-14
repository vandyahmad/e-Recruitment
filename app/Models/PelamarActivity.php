<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelamarActivity extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'pelamars_activity';

    protected $fillable = [
        'id',
        'id_pelamar',
        'activity',
        'lokasi_activity',
        'jadwal_activity',
        'keterangan'
    ];

    protected $guarded = [];

    public function pelamar()
    {
        return $this->belongsTo(pelamars::class, 'id_pelamar', 'id');
    }
}
