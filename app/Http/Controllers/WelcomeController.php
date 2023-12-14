<?php

namespace App\Http\Controllers;

use App\Models\JobVacancies;
use App\Models\pelamars;
use App\Models\UsersData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        // Retrieve all job vacancies
        $result = JobVacancies::all();
        return view('welcome', ['jobvacancies' => $result]);
    }

    public function apply()
    {
        // Add your application logic here
        // For example, you can redirect to the application form view
        $jobVacancies = JobVacancies::all();

        $userData = UsersData::where('user_id', Auth::user()->id)->first();
        // dd($userData);
        // dd(JobVacancies::where('id', $job_id)->first());
        // $jobVacancies = JobVacancies::where('id', $job_id)->first();
        if($userData){

            return view('/', ['jobVacancies' => $jobVacancies]);
        }

        else {

            return redirect()->route('pelamar.detail-login-user');
        }
        // return view('form-pendaftaran-pelamar');
    }

    
}
