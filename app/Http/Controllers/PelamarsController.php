<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\EmployeeFamily;
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
        $user = auth()->user();
        $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
            ->where('pelamars.user_id', $user->id)
            ->where('activity', 'LIKE', '%interview%')
            ->exists();
        // dd($interviewActivity);

        $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists(); 

        return view('form-pendaftaran-pelamar', compact('interviewActivity'));
    }

    protected function store(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user_data = UsersData::where('user_id', $user->id)->first();
            // dd($user_data);
            if (!$user_data) {
                Alert::error('Anda belum melengkapi data', ' Silahkan isi terlebih dahulu.');
                return redirect()->route('pelamar.detail-login-user');
            }

            $validateData = $request->validate([
                'minat_karir'   =>  'required',
                'minat_lokasi'  =>  'required',
            ]);

            //Input Database
            $pelamars = new pelamars();
            $pelamars->user_id = auth()->user()->id;
            $pelamars->minat_karir = $validateData['minat_karir'];
            $pelamars->minat_lokasi = $validateData['minat_lokasi'];
            $pelamars->save();

            $pelamars_id = $pelamars->id; // Retrieve the pelamars_id after saving

            if ($pelamars) {
                Alert::success('Pendaftaran Berhasil', 'Untuk Selanjutnya Admin Akan Menghubungi Lewat Email/Whatsapp.');
                return redirect()->route('job-applied.status', ['id' => $pelamars_id]);
            }
            if ($validateData->fails()) {
                return redirect('/')
                    ->withErrors($validateData)
                    ->withInput();
            }
        } else {
            // Handle the case when no user is authenticated
            Alert::error('Anda belum login', 'Silahkan login terlebih dahulu')->persistent(true);
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
            $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
                ->where('pelamars.user_id', $user->id)
                ->where('activity', 'LIKE', '%interview%')
                ->exists();
            // dd($interviewActivity);

            $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists(); 
            
            return view('user.profile-pelamar', compact('user', 'interviewActivity', 'incompletedFormInterview'));
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }


    public function detailLoginUser()
    {
        // Get the currently authenticated user
        $user = auth()->user();
        $cities = City::all();

        if ($user = Auth::user()) {


            $profile = UsersData::with('employee')->where('user_id', $user->id)->first();
            // $pelamars = pelamars::where('user_id', $user->id)->first();
            $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
                ->where('pelamars.user_id', $user->id)
                ->where('activity', 'LIKE', '%interview%')
                ->exists();
            // dd($interviewActivity);
            $incompletedFormInterview = $profile->form_interview != 'completed' ? true : false;
            // dd($incompletedFormInterview);
            $acceptedPelamarExists = Pelamars::where('user_id', $user->id)
                ->where('status', 'Accepted')
                ->exists();


            if ($acceptedPelamarExists == true) {
                $acceptedPelamarExists = Pelamars::where('user_id', $user->id)
                    ->where('status', 'Accepted')
                    ->exists();
                $interviewActivity = PelamarActivity::select('activity')
                    // ->where('id_pelamar', $pelamars->id)
                    ->where('activity', 'LIKE', '%interview%')
                    ->exists();
                $profile = UsersData::with('employee')->where('user_id', $user->id)->first();
                $incompletedFormInterview = $profile->form_interview != 'completed' ? true : false;
                $employee = Employee::where('id', $profile->employee->id)->first();
                $employee_families = EmployeeFamily::where('employee_id', $employee->id)->get(); // Use get() to retrieve all records
                $employee_documents = EmployeeDocument::where('employee_id', $employee->id)->get();
                if ($employee_documents->isEmpty()) {
                    $employee_documents = collect([new EmployeeDocument()]);
                }

                return view('user.detail-profile', compact('profile', 'acceptedPelamarExists', 'employee', 'employee_families', 'employee_documents', 'cities', 'interviewActivity', 'incompletedFormInterview'));
            }

            return view('user.detail-profile', compact('profile', 'acceptedPelamarExists', 'cities', 'interviewActivity', 'incompletedFormInterview'));
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }



    // public function detailProfileData()
    // {
    //     // Get the currently authenticated user
    //     $user = auth()->user();
    //     $cities = City::all();



    //     if ($user = Auth::user()) {
    //         $profile = UsersData::where('user_id', $user->id)->first();
    //         // dd($profile);
    //         $acceptedPelamarExists = Pelamars::where('user_id', $user->id)
    //             ->where('status', 'Accepted')
    //             ->exists();
    //         // dd($acceptedPelamarExists);
    //         return view('user.detail-profile-data', compact('profile', 'acceptedPelamarExists', 'cities'));
    //     } else {
    //         // Handle the case when no user is authenticated
    //         return redirect()->route('login'); // Redirect to the login page or any other desired route
    //     }
    // }

    public function jobApplied()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        if ($user) {
            $user = auth()->user();
            $userID = $user->id;
            $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
                ->where('pelamars.user_id', $userID)
                ->where('activity', 'LIKE', '%interview%')
                ->exists();

            $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists();
            // dd($interviewActivity);
            // Fetch the jobs applied by the user from the 'pelamars' table
            $appliedJobs = $user->pelamars;
            $acceptedPelamarExists = Pelamars::where('user_id', $user->id)
                ->where('status', 'Accepted')
                ->exists();
            // dd($acceptedPelamarExists);
            if ($appliedJobs === null) {
                $appliedJobs = collect(); // Assign an empty collection
            }

            return view('user.job-applied', compact('appliedJobs', 'acceptedPelamarExists', 'interviewActivity', 'incompletedFormInterview'));
        } else {
            // Handle the case when no user is authenticated
            return redirect()->route('login'); // Redirect to the login page or any other desired route
        }
    }


    public function jobAppliedStatus($id)
    {

        $interviewActivity = PelamarActivity::select('activity')
            ->where('id_pelamar', $id)
            ->where('activity', 'LIKE', '%interview%')
            ->exists();

        // dd($interviewActivity);

        // Execute the query to get the first interview activity
        $firstInterviewActivity = DB::select('
            SELECT pa.*
            FROM pelamars_activity pa
            JOIN (
                SELECT id_pelamar, MIN(created_at) AS first_interview_date
                FROM pelamars_activity
                WHERE activity LIKE ?
                GROUP BY id_pelamar
            ) first_interviews
            ON pa.id_pelamar = first_interviews.id_pelamar
            AND pa.created_at = first_interviews.first_interview_date
            LEFT OUTER JOIN pelamars p ON p.id = pa.id_pelamar
            WHERE pa.activity LIKE ?
            AND pa.created_at = p.updated_at and pa.id_pelamar = ?
        ', ['%interview%', '%interview%', $id]);

        $isFirstInterview = count($firstInterviewActivity) > 0;

        // dd($isFirstInterview);


        // dd($firstInterviewActivity);

        // // Assuming you want the first result of pelamars based on the given $id
        $minat_karir = pelamars::with('job_vacancy')->select('minat_karir', 'status')->where('id', $id)->first();
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


        $user = auth()->user();
        $activities = PelamarActivity::where('id_pelamar', $id)->get();
        // dd($activities);
        $acceptedPelamarExists = Pelamars::where('user_id', $user->id)
            ->where('status', 'Accepted')
            ->exists();

        $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists();

        // $job_vacancy_id = pelamars::select('minat_karir')->where('id', $id)->get();
        // $jobActivities = JobVacanciesActivity::select('activity_step_id')->where('job_vacancy_id', $job_vacancy_id)->get();
        // dd($activities);
        if (!$activities) {
            // Handle the case where the applied job is not found
            return view('user.job-applied-show')->with('activities', null);
        }

        return view('user.job-applied-show', compact('activities', 'jobActivities', 'minat_karir', 'acceptedPelamarExists', 'isFirstInterview', 'interviewActivity', 'incompletedFormInterview'));
    }






    // public function destroy($nik)
    // {
    //     $pelamar = pelamars::where('nik', $nik);
    //     $pelamar->delete();

    //     return redirect()->back()->with('sukses', 'data berhasil di hapus');
    // }


}
