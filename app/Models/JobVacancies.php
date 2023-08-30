<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobVacancies extends Model
{
    // protected $primaryKey = "nik";
    protected  $table = 'job_vacancies';

    protected $fillable = ['job_title','job_description','job_requirement','job_location','job_company','job_branch'];

    protected $guarded = [];
}
