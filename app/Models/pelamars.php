<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelamars extends Model
{
    // protected $primaryKey = "nik";

    protected $fillable = ['id', 'user_id', 'minat_karir', 'name', 'status'];

    protected $guarded = [];

    public function activities()
    {
        return $this->hasMany(PelamarActivity::class, 'id_pelamar', 'id');
        // return $this->hasMany(PelamarActivity::class);
    }

    public function job_vacancy()
    {
        return $this->belongsTo(JobVacancies::class, 'minat_karir', 'id');
    }

    public function userData()
    {
        return $this->belongsTo(UsersData::class, 'user_id', 'user_id' );
    }
}
