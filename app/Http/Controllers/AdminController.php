<?php

namespace App\Http\Controllers;

use App\Mail\PelamarNotification;
use App\Models\ActivityStep;
use App\Models\Branch;
use App\Models\City;
use App\Models\Employee;
use App\Models\EmployeeFamily;
use App\Models\JobPositions;
use App\Models\JobVacancies;
use Illuminate\Http\Request;
use App\Models\pelamars;
use App\Models\PelamarActivity;
use App\Models\Question;
use App\Models\User;
use App\Models\UsersData;
use App\Models\UsersDataAnswer;
use App\Models\UsersDataEducation;
use App\Models\UsersDataEmploymentHistory;
use App\Models\UsersDataFamily;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use DateTime;
use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{

    public function home()
    {
        // Get all applications
        $applications = pelamars::all();

        // Calculate the total number of applications
        $totalApplications = $applications->count();

        // dd($totalApplications);

        // Calculate the number of applications for each status
        $statusCounts = [
            'Accepted' => $applications->where('status', 'Accepted')->count(),
            'Declined' => $applications->where('status', 'Declined')->count(),
            'On Hold' => $applications->where('status', 'On Hold')->count(),
            'Apply' => $applications->where('status', 'Apply')->count()
        ];

        // Calculate "On Process" by excluding specific statuses
        $onProcessCount = $totalApplications - ($statusCounts['Accepted'] ?? 0) - ($statusCounts['Declined'] ?? 0) - ($statusCounts['On Hold'] ?? 0) - ($statusCounts['Apply'] ?? 0);

        // Count occurrences for each `info_lowongan` source
        $infoSources = [
            'Referensi',
            'Website',
            'LinkedIn',
            'JobStreet',
            'Telegram',
            'Facebook',
            'Lainnya'
        ];

        $infoLowonganCounts = [];
        foreach ($infoSources as $source) {
            $infoLowonganCounts[$source] = UsersData::where('info_lowongan', $source)->count();
        }

        // dd($infoLowonganCounts);

        return view('admin.home', compact('totalApplications', 'statusCounts', 'onProcessCount', 'infoLowonganCounts'));
    }

    //Pelamars
    public function index_pelamar(Request $request)
    {
        $branches = Branch::all();
        $statuses = ActivityStep::all();
        $jobs = JobVacancies::all();
        $cities = City::all();

        // Step 1: Fetch IDs of the pelamars to be included
        $pelamarIds = DB::table('pelamars as p')
            ->select('p.id')
            ->where('p.status', 'Accepted')
            ->orWhereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('pelamars as p2')
                    ->whereColumn('p2.user_id', 'p.user_id')
                    ->where('p2.status', 'Accepted');
            })
            ->orderBy('p.id', 'desc')
            ->pluck('id');

        // Step 2: Get the 'limit' and filter values from user input
        $limit = $request->input('limit', 100);  // Default to 25 if no limit is provided
        $pendidikanTerakhir = $request->input('pendidikan_terakhir');
        $prefLocation = $request->input('pref_location');
        $minatKarir = $request->input('minat_karir');
        $status = $request->input('status');
        $nama = $request->input('nama');

        // Step 3: Use the IDs to fetch pelamars with their relationships and apply filters
        $pelamarsQuery = pelamars::with('activities', 'job_vacancy', 'userData')
            ->whereIn('id', $pelamarIds)
            ->orderBy('id', 'desc');

        // Apply filters
        if (!empty($pendidikanTerakhir)) {
            $pelamarsQuery->whereHas('userData', function ($query) use ($pendidikanTerakhir) {
                $query->where('pendidikan_terakhir', $pendidikanTerakhir);
            });
        }
        if (!empty($prefLocation)) {
            $pelamarsQuery->where('minat_lokasi', $prefLocation);
        }
        if (!empty($minatKarir)) {
            $pelamarsQuery->whereHas('job_vacancy', function ($query) use ($minatKarir) {
                $query->where('job_title', $minatKarir);
            });
        }
        if (!empty($status)) {
            $pelamarsQuery->where('status', $status);
        }
        if (!empty($nama)) {
            $pelamarsQuery->whereHas('userData', function ($query) use ($nama) {
                $query->where(function ($query) use ($nama) {
                    $query->where('nama_lengkap', 'like', '%' . $nama . '%')
                        ->orWhere('jurusan', 'like', '%' . $nama . '%');   //awalnya hanya untuk search box nama, tapi ada tambahan mau search box jurusan
                });
            });
        }

        // Step 4: Limit the number of results based on user input
        $pelamars = $pelamarsQuery->take($limit)->get();

        // Get all applications
        $applications = pelamars::all();

        // Calculate the total number of applications
        $totalApplications = $applications->count();

        // Calculate the number of applications for each status
        $statusCounts = [
            'Accepted' => $applications->where('status', 'Accepted')->count(),
            'Declined' => $applications->where('status', 'Declined')->count(),
            'On Hold' => $applications->where('status', 'On Hold')->count(),
            'Apply' => $applications->where('status', 'Apply')->count()
        ];

        // Calculate "On Process" by excluding specific statuses
        $onProcessCount = $totalApplications - ($statusCounts['Accepted'] ?? 0) - ($statusCounts['Declined'] ?? 0) - ($statusCounts['On Hold'] ?? 0) - ($statusCounts['Apply'] ?? 0);

        // Return the view with the filtered data
        return view('admin.pelamar', [
            'pelamars' => $pelamars,
            'activitySteps' => DB::select(DB::raw("
            SELECT
                jva.sequence, jva.job_vacancy_id, jva.activity_step_id, jv.id, ac.name
            FROM job_vacancies_activity jva
            LEFT OUTER JOIN job_vacancies jv ON jv.id = jva.job_vacancy_id
            LEFT OUTER JOIN activity_steps ac ON ac.id = jva.activity_step_id
            ORDER BY 1
        ")),
            'branches' => $branches,
            'statuses' => $statuses,
            'jobs' => $jobs,
            'cities' => $cities,
            'totalApplications' => $totalApplications,
            'statusCounts' => $statusCounts,
            'onProcessCount' => $onProcessCount
        ]);
    }


    public function index_user_pelamar()
    {
        $latestEmployment = DB::table('users_data_employment_history as eh')
            ->select(
                'eh.user_id',
                'eh.jabatan',
                'eh.nama_perusahaan',
                'eh.tanggal_masuk',
                'eh.tanggal_keluar',
                DB::raw('ROW_NUMBER() OVER (PARTITION BY eh.user_id ORDER BY eh.tanggal_masuk DESC) as rn')
            )
            ->toSql(); // To use it in the next subquery

        $userPelamars = DB::table('users_data as ud')
            ->select(
                'ud.user_id',
                'ud.nik',
                'ud.nama_lengkap',
                'ud.no_hp',
                'ud.pendidikan_terakhir',
                'ud.jurusan',
                'ud.institusi',
                'le.jabatan',
                'le.nama_perusahaan',
                'le.tanggal_masuk',
                'le.tanggal_keluar'

            )
            ->leftJoin(DB::raw("($latestEmployment) as le"), function ($join) {
                $join->on('ud.user_id', '=', 'le.user_id')
                    ->where('le.rn', '=', 1); // Only get the row where rn = 1 (most recent job)
            })
            ->get();
        // dd($userPelamars);
        return view('admin.user-pelamar', ['userPelamars' => $userPelamars]);
    }

    public function show_pelamar($pelamar)
    {
        $result = pelamars::with('userData', 'job_vacancy')->find($pelamar);
        $userData = UsersData::where('user_id', $result->user_id)->first();
        // dd($result->userData->upload_file);
        return view('admin.detail', ['pelamar' => $result], ['userData' => $userData]);
    }

    public function show_user_pelamar($id)
    {
        $userData = UsersData::all()->where('user_id', $id)->first();
        // dd($result->userData->upload_file);
        return view('admin.user-detail', ['userData' => $userData]);
    }

    public function cetak_pelamar($pelamar)
    {
        $result = pelamars::with('userData', 'job_vacancy')->where('id', $pelamar)->first();
        // dd(asset('public/uploads/images/' . $result->userData->upload_foto));
        $pdf = PDF::loadView('admin.cetak', ['result' => $result]);
        return $pdf->stream();
    }

    public function contact_pelamar()
    {
        $result = pelamars::with('userData', 'job_vacancy')->get();
        return view('admin.contact', ['pelamar' => $result]);
    }

    // public function cetak_pelamar($pelamar)
    // {
    //     $pelamar = pelamars::with('userData', 'job_vacancy')->whereHas('userData', function ($query) use ($pelamar) {
    //         $query->where('nik', $pelamar);
    //     })->first();

    //     $pdf = PDF::loadView('admin.cetak', ['result' => $pelamar]);
    //     return $pdf->stream();
    // }


    public function destroy_pelamar($pelamar)
    {
        $pelamar = pelamars::where('id', $pelamar);
        $pelamar->delete();

        Alert::success('Sukses', 'Data berhasil di hapus');
        return redirect('/admin/pelamars');
        // return redirect()->back()->with('sukses', 'data berhasil di hapus');
    }


    // public function activity_step()
    // {
    //     // Fetch activity steps
    //     $activitySteps = DB::table('activity_steps')->get();

    //     // Pass data to the view
    //     return view('admin/pelamar', ['activitySteps' => $activitySteps, /* other variables */]);
    // }

    public function process(Request $request)
    {

        // Validasi data input sesuai kebutuhan
        if ($request->input('activity') != 'Declined' && $request->input('activity') != 'Screening' && $request->input('activity') != 'On Hold' && $request->input('activity') != 'Psikotes (with Talenta)') {
            $request->validate([
                'activity' => 'required',
                'jadwal_activity' => 'required',
                'lokasi_activity' => 'required',
                // 'keterangan' => 'required',
            ]);
        };

        try {

            // Format jadwal_activity datetime string
            $jadwalActivity = DateTime::createFromFormat('d/m/Y H:i', $request->input('jadwal_activity'));

            if (!$jadwalActivity) {
                throw new \Exception('Failed to parse jadwal_activity datetime string.');
            }

            // Convert DateTime object to string in the format needed for database storage
            $formattedJadwalActivity = $jadwalActivity->format('Y-m-d H:i:s');



            $pelamar = pelamars::with('activities', 'job_vacancy', 'userData')->leftJoin('job_vacancies as jv', 'jv.id', '=', 'pelamars.minat_karir')->find($request->input('pelamarID'));
            $nama = $pelamar->userData->nama_lengkap;
            $status = $pelamar->status;
            $minat = $pelamar->job_title;
            $minat_lokasi = $pelamar->minat_lokasi;

            // Save data to pelamars_activity table
            $data = new PelamarActivity();
            $data->id_pelamar = $request->input('pelamarID');
            $data->activity = $request->input('activity');
            $data->jadwal_activity = $formattedJadwalActivity; // Use the formatted datetime string
            $data->lokasi_activity = $request->input('lokasi_activity');
            $data->keterangan = $request->input('keterangan');
            $data->email_sent_at = now();

            $data->save();


            // Update pelamars table
            $update = pelamars::find($request->input('pelamarID'));
            $update->status = $request->input('activity');
            $update->save();

            // Check if it's the first interview
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
            ', ['%interview%', '%interview%', $request->input('pelamarID')]);

            $isFirstInterview = count($firstInterviewActivity) > 0;

            // Process if activity is 'Accepted'
            if ($request->input('activity') == 'Accepted') {
                if ($pelamar->job_vacancy->job_company == 'ecoCare') {
                    $company_code = 'ECO';
                } elseif ($pelamar->job_vacancy->job_company == 'TukangBersih') {
                    $company_code = 'TBI';
                } else {
                    $company_code = 'PEST';
                }

                // Get the latest employee record to determine the last nip
                $latestEmployee = Employee::where('company_code', $company_code)->latest()->first();
                $lastNipNumber = 1;
                if ($latestEmployee) {

                    // Extract the numeric part of the last nip and increment it
                    $lastNipNumber = intval(substr($latestEmployee->nip, 4)) + 1;
                }

                // Pad the incremented number with leading zeros to match the format
                $newNipNumber = str_pad($lastNipNumber, 5, '0', STR_PAD_LEFT);

                $employee = new Employee();
                $employee->user_id = $pelamar->user_id;
                $employee->company_code = $company_code;
                $employee->nik = $pelamar->userData->nik;
                $employee->nip = $company_code . '-' . $newNipNumber;
                $employee->nama_lengkap = $pelamar->userData->nama_lengkap;
                $employee->jabatan = $pelamar->job_title;
                $employee->status_karyawan = $request->input('status_karyawan');
                $employee->tanggal_mulai_kerja = $request->input('tanggal_mulai_kerja');
                $employee->tanggal_selesai_kerja = $request->input('tanggal_selesai_kerja');
                $employee->jenis_kelamin = $pelamar->userData->jenis_kelamin;
                $employee->agama = $pelamar->userData->agama;
                $employee->tempat_lahir = $pelamar->userData->tempat_lahir;
                $employee->tanggal_lahir = $pelamar->userData->tanggal_lahir;
                $employee->alamat = $pelamar->userData->alamat;
                $employee->email = $pelamar->userData->email;
                $employee->no_hp = $pelamar->userData->no_hp;
                $employee->pendidikan_terakhir = $pelamar->userData->pendidikan_terakhir;
                $employee->jurusan = $pelamar->userData->jurusan;
                $employee->institusi = $pelamar->userData->institusi;
                $employee->nilai = $pelamar->userData->nilai;
                $employee->upload_foto = $pelamar->userData->upload_foto;
                $employee->upload_file = $pelamar->userData->upload_file;

                // Save the employee record
                $employee->save();

                $userDataFamilies = UsersDataFamily::where('user_id', $pelamar->user_id)->get();

                foreach ($userDataFamilies as $userDataFamily) {
                    $employeeFamily = new EmployeeFamily();
                    $employeeFamily->employee_id = $employee->id;
                    $employeeFamily->hubungan_fam = $userDataFamily->hubungan;
                    $employeeFamily->nama_fam = $userDataFamily->nama;
                    $employeeFamily->usia_fam = $userDataFamily->usia;
                    $employeeFamily->jenis_kelamin_fam = $userDataFamily->jenis_kelamin;
                    $employeeFamily->pendidikan_terakhir_fam = $userDataFamily->pendidikan_terakhir;
                    $employeeFamily->pekerjaan_fam = $userDataFamily->pekerjaan;
                    $employeeFamily->perusahaan_tempat_kerja_fam = $userDataFamily->perusahaan_tempat_kerja;
                    $employeeFamily->alamat_fam = $userDataFamily->alamat;
                    $employeeFamily->save();
                }

                Alert::success('Sukses', 'Data EMPLOYEE berhasil di proses, email sent');
            } else {
                Alert::success('Sukses', 'Data pelamar berhasil di proses, email sent');
            }

            if ($request->input('activity') != 'Screening' && $request->input('activity') != 'On Hold') {
                // Send email
                Mail::to($pelamar->userData->email)->send(new PelamarNotification($nama, $status, $minat, $minat_lokasi, $request->input('activity'), $request->input('lokasi_activity'), $formattedJadwalActivity, $request->input('keterangan'), $request->input('pelamarID'), $isFirstInterview));
            }


            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            Alert::error('Error', 'Failed to send email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.' . $e->getMessage()
            ]);
        }


        // Email was sent successfully

        // return redirect()->back()->with('success', 'Email sent successfully.');


    }

    public function activity($id_pelamar)
    {
        // Fetch the activity data using $id_pelamar
        $activities = PelamarActivity::with('pelamar')->where('id_pelamar', $id_pelamar)->get(); // Replace 'id_pelamar' with your actual field name
        // dd($activity);
        $pelamar = pelamars::with('userData', 'job_vacancy')->find($id_pelamar);
        $nama = $pelamar->userData ? $pelamar->userData->nama_lengkap : null;
        $nik = $pelamar->userData ? $pelamar->userData->nik : null;
        $minat_karir = $pelamar->job_vacancy->job_title;
        // dd($minat_karir);
        return view('admin/activity-pelamar', compact('activities', 'nama', 'nik', 'minat_karir'));
    }

    public function exportFormInterview($id)
    {

        $user = User::findOrFail($id);
        $userData = UsersData::where('user_id', $id)->first();
        $pelamar = pelamars::with('userData', 'job_vacancy')->where('user_id', $id)->first();
        $questions = Question::all();
        $userDataEducation = UsersDataEducation::where('user_id', $id)->first();
        $userDataAnswers = UsersDataAnswer::where('user_id', $id)->get();
        $userDataFamilies = UsersDataFamily::where('user_id', $id)->get();
        $userDataEmployments = UsersDataEmploymentHistory::where('user_id', $id)->get();

        // dd($pelamar->job_vacancy->job_title);

        $data = [
            'user' => $user,
            'userData' => $userData,
            'pelamar' => $pelamar,
            'questions' => $questions,
            'userDataEducation' => $userDataEducation,
            'userDataAnswers' => $userDataAnswers,
            'userDataFamilies' => $userDataFamilies,
            'userDataEmployments' => $userDataEmployments
        ];

        $pdf = PDF::loadView('admin.cetak-form-interview', $data);

        // return $pdf->download('form-interview-'. $user->name . '.pdf');
        return $pdf->stream('form-interview-' . $user->name . '.pdf');
    }


    public function index_job_positions()
    {
        $jobPositions = JobPositions::all();
        return view('admin.job-positions.index', compact('jobPositions'));
    }

    // Show the form for creating a new job position
    public function create_job_positions()
    {

        return view('admin.job-positions.create');
    }

    // Store a newly created job position in storage
    public function store_job_positions(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        JobPositions::create($validatedData);

        return redirect()->route('admin.index_job_positions')->with('success', 'Job Position created successfully.');
    }

    // Show the form for editing the specified job position
    public function edit_job_positions($id)
    {
        $jobPosition = JobPositions::findOrFail($id);
        return view('admin.job-positions.edit', compact('jobPosition'));
    }

    // Update the specified job position in storage
    public function update_job_positions(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $jobPosition = JobPositions::findOrFail($id);
        $jobPosition->update($validatedData);

        return redirect()->route('admin.index_job_positions')->with('success', 'Job Position updated successfully.');
    }

    // Remove the specified job position from storage
    public function destroy_job_positions($id)
    {
        $jobPosition = JobPositions::findOrFail($id);
        $jobPosition->delete();

        return redirect()->route('admin.index_job_positions')->with('success', 'Job Position deleted successfully.');
    }


    //Candidates
    // public function index_candidate()
    // {
    //     $candidate = Candidates::paginate(10);

    //     return view('admin.candidate', ['candidate' => $candidate]);
    // }

    // public function show_candidate($candidate)
    // {
    //     $result = Candidates::find($candidate);
    //     return view('admin.detail', ['candidate' => $result]);
    // }

    // public function contact_candidate()
    // {
    //     $result = Candidates::all();
    //     return view('admin.contact', ['candidate' => $result]);
    // }

    // public function cetak_candidate($candidate)
    // {
    //     $candidate = Candidates::where('nik', $candidate)->first();

    //     $pdf = PDF::loadView('admin.cetak', ['result' => $candidate]);
    //     return $pdf->stream();
    // }


    // public function destroy_candidate($candidate)
    // {
    //     $candidate = Candidates::where('id', $candidate);
    //     $candidate->delete();

    //     return redirect()->back()->with('sukses', 'data berhasil di hapus');
    // }


    // //Employee
    // public function employee()
    // {
    //     $result = Employee::all();
    //     return view('admin.employee', ['employee' => $result]);
    // }
}
