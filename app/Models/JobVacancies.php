<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancies extends Model
{

    protected  $table = 'job_vacancies';

    protected $fillable = ['job_title', 'job_type', 'job_functional','job_level', 'job_description', 'job_requirement', 'job_location', 'job_company', 'job_branch', 'job_start_date', 'job_end_date'];

    protected $guarded = [];

    public function vacancy()
    {
        return $this->hasMany(JobVacanciesActivity::class, 'job_vacancy_id', 'id');
        // return $this->hasMany(PelamarActivity::class);
    }

    public function pelamar()
    {
        return $this->hasMany(pelamars::class, 'minat_karir', 'id');
        // return $this->hasMany(PelamarActivity::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
