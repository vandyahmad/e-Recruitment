<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\JobVacancies;
use App\Models\pelamars;
use App\Models\UsersData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        // Retrieve all job vacancies
        $result = JobVacancies::all();
        $cities = City::all();

        return view('welcome', ['jobvacancies' => $result, 'cities' => $cities]);
    }

    public function index_filter()
    {
        // Retrieve all job vacancies
        $result = JobVacancies::all();
        $cities = City::all();

        // Check if a user is authenticated
        if (Auth::check()) {
            $userPelamar = pelamars::where('user_id', Auth::user()->id)->get();

            // Check if the user has any accepted applications
            $hasAcceptedApplication = $userPelamar->contains(function ($pelamar) {
                return $pelamar->status === 'Accepted';
            });

            return view('job-filter', [
                'jobvacancies' => $result,
                'cities' => $cities,
                'hasAcceptedApplication' => $hasAcceptedApplication
            ]);
        } else {
            // If no user is authenticated, just return the view with job vacancies and cities
            return view('job-filter', [
                'jobvacancies' => $result,
                'cities' => $cities,
                'hasAcceptedApplication' => false // Default to false if not authenticated
            ]);
        }
    }


    public function filter(Request $request)
    {
        $searchQuery = $request->input('searchQuery');
        $job_location = $request->input('job_location');
        $job_type = $request->input('job_type');
        $job_company = $request->input('job_company');
        $job_functional = $request->input('job_functional');
        $job_level = $request->input('job_level');

        // Retrieve the job vacancies that have end dates greater than or equal to the current date
        $filter_job = JobVacancies::where('job_end_date', '>=', Carbon::now('Asia/Jakarta'));

        // Apply additional filters based on user input

        if ($searchQuery) {
            $filter_job->where('job_title', 'like', '%' . $searchQuery . '%'); // Search for partial matches in job titles
        }


        if ($job_location) {
            $filter_job->where('job_location', 'like', '%' . $job_location . '%');
        }

        if ($job_company) {
            $filter_job->where('job_company', $job_company);
        }

        if ($job_type) {
            $filter_job->where('job_type', $job_type);
        }

        if ($job_functional) {
            $filter_job->where('job_functional', $job_functional);
        }

        if ($job_level) {
            $filter_job->where('job_level', 'like', '%' . $job_level . '%');
        }

        // Execute the query and retrieve the filtered job vacancies
        $filtered_job_vacancies = $filter_job->get();

        // Return the filtered job vacancies as JSON response
        return response()->json($filtered_job_vacancies);
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
        if ($userData) {

            return view('/', ['jobVacancies' => $jobVacancies]);
        } else {

            return redirect()->route('pelamar.detail-login-user');
        }
        // return view('form-pendaftaran-pelamar');
    }
}
