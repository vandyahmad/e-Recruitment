<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacanciesActivity extends Model
{
    //
    protected  $table = 'job_vacancies_activity';
    protected $fillable = ['job_vacancy_id','sequence','activity_step_id'];


    public function vacancy_activity()
    {
        return $this->belongsTo(JobVacancies::class, 'job_vacancy_id', 'id');
    }
}
