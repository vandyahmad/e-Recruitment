<?php

namespace App\Http\Controllers;

use App\Models\JobVacancies;
use App\Models\JobVacanciesActivity;
use App\Models\pelamars;
use App\Models\PelamarActivity;
use App\Models\User;
use App\Models\UsersData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PelamarsController extends Controller
{
    // public function index()
    // {
    //     // $pelamar = pelamars::all();
    //     // return view('admin.pelamar', compact('pelamar'));

    // }

    public function create()
    {
        return view('form-pendaftaran-pelamar');
    }

    protected function store(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $validateData = $request->validate([
                'minat_karir'   =>  'required',
            ]);

            //Input Database
            $pelamars = new pelamars();
            $pelamars->user_id = auth()->user()->id;
            $pelamars->minat_karir = $validateData['minat_karir'];
            $pelamars->save();

            if ($pelamars) {
                Alert::success('Pendaftaran Berhasil', 'Untuk Selanjutnya Admin Akan Menghubungi Lewat Email/Whatsapp.');
                return redirect('/job-applied');
            }
            if ($validateData->fails()) {
                return redirect('/')
                    ->withErrors($validateData)
                    ->withInput();
            }
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }

    // public function show(pelamars $pelamars)
    // {
    //     $detail_pelamar = pelamars::where('nik', $pelamars);
    //     $detail_pelamar->first();

    //     return view('admin.detail', ['detail_pelamar' => $pelamars]);
    // }

    public function edit(pelamars $pelamars)
    {
        //
    }

    public function update(Request $request, pelamars $pelamars)
    {
        //
    }


    public function index()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        if ($user) {
            return view('user.profile-pelamar', compact('user'));
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }


    public function detailLoginUser()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        if ($user = Auth::user()) {
            $profile = UsersData::where('user_id', $user->id)->first();
            // dd($profile);
            return view('user.detail-profile', compact('profile'));
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }

    public function jobApplied()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        if ($user) {
            // Fetch the jobs applied by the user from the 'pelamars' table
            $appliedJobs = $user->pelamars;

            if ($appliedJobs === null) {
                $appliedJobs = collect(); // Assign an empty collection
            }

            return view('user.job-applied', compact('appliedJobs'));
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }


    public function jobAppliedStatus($id)
    {
        // // Retrieve the applied job details along with its related pelamar
        // // Assuming you want the first result of pelamars based on the given $id
        $minat_karir = pelamars::with('job_vacancy')->select('minat_karir','status')->where('id', $id)->first();
        // $pelamar_activity = PelamarActivity::select('activity')->where('id_pelamar', $id)->get();
        // dd($minat_karir);

        if ($minat_karir) {
            // Extract the actual value from the result
            $minat_karir_value = $minat_karir->minat_karir;

            //     // Assuming 'activity_step_id' is the field you want to select from JobVacanciesActivity
            //     $jobActivities = JobVacanciesActivity::select('activity_step_id')
            //         ->where('job_vacancy_id', $minat_karir_value)
            //         ->get();
        
            $jobActivities = DB::select(DB::raw("
        SELECT
            jva.`sequence`
            ,jva.job_vacancy_id
            ,jva.activity_step_id
            ,jv.id
            ,ac.name
        FROM job_vacancies_activity jva
        LEFT OUTER JOIN job_vacancies jv ON jv.id = jva.job_vacancy_id
        LEFT OUTER JOIN activity_steps ac ON ac.id = jva.activity_step_id
        where jva.job_vacancy_id = $minat_karir_value
        order by 1
        "));
            // dd($jobActivities);
        } else {
            // Handle the case where no pelamars record is found for the given $id
            dd('No pelamars found for the given id');
        }



        $activities = PelamarActivity::where('id_pelamar', $id)->get();
        // $job_vacancy_id = pelamars::select('minat_karir')->where('id', $id)->get();
        // $jobActivities = JobVacanciesActivity::select('activity_step_id')->where('job_vacancy_id', $job_vacancy_id)->get();
        // dd($activities);
        if (!$activities) {
            // Handle the case where the applied job is not found
            return view('user.job-applied-show')->with('activities', null);
        }

        return view('user.job-applied-show', compact('activities', 'jobActivities', 'minat_karir'));
    }





    // public function destroy($nik)
    // {
    //     $pelamar = pelamars::where('nik', $nik);
    //     $pelamar->delete();

    //     return redirect()->back()->with('sukses', 'data berhasil di hapus');
    // }


}
