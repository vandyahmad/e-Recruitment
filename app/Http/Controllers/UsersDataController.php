<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\JobVacancies;
use App\Models\JobVacanciesActivity;
use App\Models\pelamars;
use App\Models\PelamarActivity;
use App\Models\Question;
use App\Models\User;
use App\Models\UsersData;
use App\Models\UsersData as ModelsUsersData;
use App\Models\UsersDataAnswer;
use App\Models\UsersDataEducation;
use App\Models\UsersDataEmploymentHistory;
use App\Models\UsersDataFamily;
use Carbon\Carbon;
use Dotenv\Regex\Success;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UsersDataController extends Controller
{
    // public function index()
    // {
    //     // $pelamar = pelamars::all();
    //     // return view('admin.pelamar', compact('pelamar'));

    // }

    public function create()
    {
        $cities = City::all();
        $user = auth()->user();
        $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
            ->where('pelamars.user_id', $user->id)
            ->where('activity', 'LIKE', '%interview%')
            ->exists();
        // dd($interviewActivity);
        $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists();
        return view('form-data-pelamar', compact('cities', 'interviewActivity', 'incompletedFormInterview'));
    }

    protected function store(Request $request)
    {
        $validateData = $request->validate([
            'info_lowongan' => 'required',
            'nik'           =>  'required|min:14|max:16|unique:users_data',
            'nama_lengkap'  =>  'required|string|max:300',
            'jenis_kelamin' =>  'required|in:P,L',
            'tempat_lahir'  =>  'required|string',
            'tanggal_lahir' =>  'required|date',
            'agama'         =>  'required|string',
            // 'alamat'        =>  'required|string',
            'pref_location' =>  'required|string',
            'email'         =>  'required|string|email|max:50',
            'no_hp'         =>  'required',
            'pendidikan_terakhir'   => 'required',
            'jurusan'       =>  'required',
            'institusi'       =>  'required',
            'nilai'       =>  'required',
            'upload_foto'    => 'required|file|image|max:20000',
            'upload_file'   =>  'required|file|mimes:pdf|max:20000',
        ]);


        //Mengambil request object untuk proses upload file
        $request = request();


        //Proses Upload file gambar profil
        if ($request->hasFile('upload_foto')) {
            //Menggunakan slug helper agar "nama" bisa di pakai sebagai bagian  dari nama gambar_profil
            $slug = str::slug($request['nama_lengkap']);

            // Mengambil extensi file asli
            $extImage = $request->upload_foto->getClientOriginalExtension();

            // Generate nama_gambar, gabungan dari slug "nama" + time() + extensi file
            $namaImage = $slug . '-' . time() . "." . $extImage;

            // Proses Upload, simpan ke dalam folder "uploads"
            $request->file('upload_foto')->move('public/uploads/images', $namaImage);
        } else {
            //Jika User tidak mengupload gambar, isi dengan gambar default
            $namaImage = 'default_profile.jpg';
        }

        //proses Upload File
        $namaFile = '';
        if ($request->hasFile('upload_file')) {
            //Slug
            $slug = Str::slug($request['nama_lengkap']);
            //Extensi
            $extFile = $request->upload_file->getClientOriginalExtension();
            //generate
            $namaFile = $slug . '-' . time() . "." . $extFile;
            //Proses Upload
            $request->file('upload_file')->move('public/uploads/files', $namaFile);
        }

        // Store the form data in the session
        // $request->session()->put('application_data', $request->except(['_token']));

        //Input Database
        // $tanggal_lahir = \Carbon\Carbon::createFromFormat('d-m-Y', $validateData['tanggal_lahir'])->format('Y-m-d');
        $profiles = new usersData();
        $profiles->user_id = auth()->user()->id;
        $profiles->nik = $validateData['nik'];
        $profiles->nama_lengkap = $validateData['nama_lengkap'];
        $profiles->jenis_kelamin = $validateData['jenis_kelamin'];
        $profiles->tempat_lahir = $validateData['tempat_lahir'];
        $profiles->tanggal_lahir = $validateData['tanggal_lahir'];
        $profiles->info_lowongan = $validateData['info_lowongan'];
        $profiles->agama = $validateData['agama'];
        // $profiles->alamat = $validateData['alamat'];
        $profiles->pref_location = $validateData['pref_location'];
        $profiles->email = $validateData['email'];
        $profiles->no_hp = $validateData['no_hp'];
        $profiles->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
        $profiles->jurusan = $validateData['jurusan'];
        $profiles->institusi = $validateData['institusi'];
        $profiles->nilai = str_replace(',', '.', $validateData['nilai']);
        $profiles->upload_foto = $namaImage;
        $profiles->upload_file = $namaFile;
        $profiles->save();

        if ($profiles) {
            Alert::success('Sukses!', 'Data Anda berhasil disimpan!');
            return redirect('/detail-profile');
        }
        if ($validateData->fails()) {
            return redirect('/form-data-pelamar')
                ->withErrors($validateData)
                ->withInput();
        }

        // $now = Carbon::now();

        // // Filter job vacancies with end dates in the future
        // $jobVacancies = JobVacancy::where('job_end_date', '>=', $now)->get();

        // return view('your_view', ['jobVacancies' => $jobVacancies]);
    }
    // public function show(pelamars $pelamars)
    // {
    //     $detail_pelamar = pelamars::where('nik', $pelamars);
    //     $detail_pelamar->first();

    //     return view('admin.detail', ['detail_pelamar' => $pelamars]);
    // }

    // public function edit(pelamars $pelamars)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'info_lowongan' =>  'required|string|max:300',
            'nik'           =>  'required|min:14|max:16',
            'nama_lengkap'  =>  'required|string|max:300',
            'jenis_kelamin' =>  'required|in:P,L',
            'tempat_lahir'  =>  'required|string|',
            'tanggal_lahir' =>  'required|date',
            'agama'         =>  'required|string|',
            // 'alamat'        =>  'required|string',
            'pref_location' =>  'required|string',
            'email'         =>  'required|string|email|max:255',
            'no_hp'         =>  'required',
            'pendidikan_terakhir'   => 'required',
            'jurusan'       =>  'required',
            'institusi'       =>  'required',
            'nilai'       =>  'required',
            'upload_foto'    => 'file|image|max:20000',
            'upload_file'   =>  'file|mimes:pdf|max:20000',
        ]);


        //Mengambil request object untuk proses upload file
        $request = request();


        $profiles = usersData::find($id);

        // Initialize $namaImage
        $namaImage = $profiles->upload_foto;
        $namaFile = $profiles->upload_file;

        // Check if the user uploaded a new image
        if ($request->hasFile('upload_foto')) {
            // Menggunakan slug helper agar "nama" bisa di pakai sebagai bagian dari nama gambar_profil
            $slug = str::slug($request['nama_lengkap']);

            // Mengambil extensi file asli
            $extFile = $request->upload_foto->getClientOriginalExtension();

            // Generate nama_gambar, gabungan dari slug "nama" + time() + extensi file
            $namaImage = $slug . '-' . time() . "." . $extFile;

            // Proses Upload, simpan ke dalam folder "uploads"
            $request->file('upload_foto')->move('public/uploads/images', $namaImage);
        }

        // Check if the user uploaded a new file
        if ($request->hasFile('upload_file')) {
            // Menggunakan slug helper agar "nama" bisa di pakai sebagai bagian dari nama gambar_profil
            $slug = str::slug($request['nama_lengkap']);

            // Mengambil extensi file asli
            $extFile = $request->upload_file->getClientOriginalExtension();

            // Generate nama_gambar, gabungan dari slug "nama" + time() + extensi file
            $namaFile = $slug . '-' . time() . "." . $extFile;

            // Proses Upload, simpan ke dalam folder "uploads"
            $request->file('upload_file')->move('public/uploads/files', $namaFile);
        }

        // proses Upload File
        // if ($request->hasFile('upload_file')) {
        //     //Slug
        //     $slug = Str::slug($request['nama_lengkap']);
        //     //Extensi
        //     $extFile = $request->upload_file->getClientOriginalExtension();
        //     //generate
        //     $namaFile = $slug . '.' . time() . "." . $extFile;
        //     //Proses Upload
        //     $request->file('upload_file')->move('uploads/files', $namaFile);
        // }

        // Store the form data in the session
        // $request->session()->put('application_data', $request->except(['_token']));

        //UPdate Database

        $profiles->user_id = auth()->user()->id;
        $profiles->nik = $validateData['nik'];
        $profiles->nama_lengkap = $validateData['nama_lengkap'];
        $profiles->jenis_kelamin = $validateData['jenis_kelamin'];
        $profiles->tempat_lahir = $validateData['tempat_lahir'];
        $profiles->tanggal_lahir = $validateData['tanggal_lahir'];
        $profiles->agama = $validateData['agama'];
        // $profiles->alamat = $validateData['alamat'];
        $profiles->info_lowongan = $validateData['info_lowongan'];
        $profiles->pref_location = $validateData['pref_location'];
        $profiles->email = $validateData['email'];
        $profiles->no_hp = $validateData['no_hp'];
        $profiles->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
        $profiles->jurusan = $validateData['jurusan'];
        $profiles->institusi = $validateData['institusi'];
        $profiles->nilai = str_replace(',', '.', $validateData['nilai']);
        $profiles->upload_foto = $namaImage;
        $profiles->upload_file = $namaFile;
        $profiles->save();

        if ($profiles) {
            Alert::success('Sukses!', 'Data Anda berhasil diupdate!');
            return redirect('/detail-profile');
        }
        if ($validateData->fails()) {
            return redirect('/detail-profile')
                ->withErrors($validateData)
                ->withInput();
        }
    }


    // public function index()
    // {
    //     // Get the currently authenticated user
    //     $user = auth()->user();

    //     if ($user) {
    //         $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
    //             ->where('pelamars.user_id', $user->id)
    //             ->where('activity', 'LIKE', '%interview%')
    //             ->exists();

    //         $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists();

    //         return view('user.profile-pelamar', compact('user', 'interviewActivity'));
    //     } else {
    //         // Handle the case when no user is authenticated
    //         return redirect()->route('login'); // Redirect to the login page or any other desired route
    //     }
    // }


    // public function detailLoginUser()
    // {
    //     // Get the currently authenticated user
    //     $user = auth()->user();

    //     if ($user) {
    //         $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
    //             ->where('pelamars.user_id', $user->id)
    //             ->where('activity', 'LIKE', '%interview%')
    //             ->exists();
    //         // dd($interviewActivity);

    //         $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists();

    //         // dd($interviewActivity);
    //         $pelamars = pelamars::all();
    //         return view('user.detail-profile', compact('pelamars', 'user', 'interviewActivity', 'incompletedFormInterview'));
    //     } else {
    //         // Handle the case when no user is authenticated
    //         return redirect()->route('login'); // Redirect to the login page or any other desired route
    //     }
    // }

    // public function jobApplied()
    // {
    //     // Get the currently authenticated user
    //     $user = auth()->user();

    //     if ($user) {
    //         $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
    //             ->where('pelamars.user_id', $user->id)
    //             ->where('activity', 'LIKE', '%interview%')
    //             ->exists();
    //         // dd($interviewActivity);

    //         // dd($interviewActivity);

    //         // Fetch the jobs applied by the user from the 'pelamars' table
    //         $appliedJobs = $user->pelamars;

    //         if ($appliedJobs === null) {
    //             $appliedJobs = collect(); // Assign an empty collection
    //         }

    //         return view('user.job-applied', compact('appliedJobs', 'interviewActivity'));
    //     } else {
    //         // Handle the case when no user is authenticated
    //         return redirect()->route('login'); // Redirect to the login page or any other desired route
    //     }
    // }


    // public function jobAppliedStatus($id)
    // {
    //     $user = auth()->user();
    //     // // Retrieve the applied job details along with its related pelamar
    //     // // Assuming you want the first result of pelamars based on the given $id
    //     $minat_karir = pelamars::select('minat_karir')->where('id', $id)->first();
    //     // dd($minat_karir);

    //     if ($minat_karir) {
    //         // Extract the actual value from the result
    //         $minat_karir_value = $minat_karir->minat_karir;

    //         //     // Assuming 'activity_step_id' is the field you want to select from JobVacanciesActivity
    //         //     $jobActivities = JobVacanciesActivity::select('activity_step_id')
    //         //         ->where('job_vacancy_id', $minat_karir_value)
    //         //         ->get();
    //         $jobActivities = DB::select(DB::raw("
    //     SELECT
    //         jva.`sequence`
    //         ,jva.job_vacancy_id
    //         ,jva.activity_step_id
    //         ,jv.id
    //         ,ac.name
    //     FROM job_vacancies_activity jva
    //     LEFT OUTER JOIN job_vacancies jv ON jv.id = jva.job_vacancy_id
    //     LEFT OUTER JOIN activity_steps ac ON ac.id = jva.activity_step_id
    //     where jva.job_vacancy_id = $minat_karir_value
    //     order by 1
    //     "));
    //         // dd($jobActivities);
    //     } else {
    //         // Handle the case where no pelamars record is found for the given $id
    //         dd('No pelamars found for the given id');
    //     }



    //     $activities = PelamarActivity::where('id_pelamar', $id)->get();
    //     // $job_vacancy_id = pelamars::select('minat_karir')->where('id', $id)->get();
    //     // $jobActivities = JobVacanciesActivity::select('activity_step_id')->where('job_vacancy_id', $job_vacancy_id)->get();
    //     // dd($jobActivities);

    //     $interviewActivity = PelamarActivity::select('activity')->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
    //         ->where('pelamars.user_id', $user->id)
    //         ->where('activity', 'LIKE', '%interview%')
    //         ->exists();
    //     // dd($interviewActivity);

    //     // dd($interviewActivity);
    //     if (!$activities) {
    //         // Handle the case where the applied job is not found
    //         return view('user.job-applied-show')->with('activities', null);
    //     }

    //     return view('user.job-applied-show', compact('activities', 'jobActivities', 'minat_karir', 'interviewActivity'));
    // }


    public function createFormInterview()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $incompletedFormInterview = UsersData::where('user_id', $user->id)->where('form_interview', '!=', 'completed')->exists();

        if ($incompletedFormInterview) {
            $userID = $user->id;
            $userData = UsersData::where('user_id', $userID)->first();
            $userDataEducation = UsersDataEducation::where('user_id', $userID)->first();
            // dd($userData);
            // dd($userDataEducation);
            $userDataFamilies = UsersDataFamily::where('user_id', $userID)->get();
            $userDataEmploymentHistories = UsersDataEmploymentHistory::where('user_id', $userID)->get();
            $questions = Question::all();
            // dd($ExplainQuestions);

            $interviewActivity = PelamarActivity::select('activity')
                ->join('pelamars', 'pelamars.id', '=', 'pelamars_activity.id_pelamar')
                ->where('pelamars.user_id', $userID)
                ->where('activity', 'LIKE', '%interview%')
                ->exists();


            // dd($incompletedFormInterview);

            return view('user.form-interview', compact('interviewActivity', 'userID', 'userData', 'userDataFamilies', 'userDataEducation', 'userDataEmploymentHistories', 'questions', 'incompletedFormInterview'));
        } else {
            return redirect()->route('pelamar.job-applied')->with('info', 'Anda telah melengkapi form interview');
        }
    }

    public function updateIdentity(Request $request, $id)
    {
        $validatedData = $request->validate([
            // 'info_lowongan' => 'required',
            'nama_panggilan' => 'required',
            'tinggi_badan' => 'required|numeric|min:50|max:250',
            'berat_badan' => 'required|numeric',
            'status_kawin' => 'required',
            'warga_negara' => 'required',
            'jalan_ktp' => 'required',
            'no_rumah_ktp' => 'required',
            'rt_ktp' => 'required',
            'rw_ktp' => 'required',
            'kel_ktp' => 'required',
            'kec_ktp' => 'required',
            'kota_ktp' => 'required',
            'prov_ktp' => 'required',
            'kode_pos_ktp' => 'required',
            'sama_dengan_ktp' => 'required',
            'jalan_domisili' => 'required',
            'no_rumah_domisili' => 'required',
            'rt_domisili' => 'required',
            'rw_domisili' => 'required',
            'kel_domisili' => 'required',
            'kec_domisili' => 'required',
            'kota_domisili' => 'required',
            'prov_domisili' => 'required',
            'kode_pos_domisili' => 'required',
            'sim_a' => 'nullable|string|min:12|max:16',
            'sim_b' => 'nullable|string|min:12|max:16',
            'sim_c' => 'nullable|string|min:12|max:16',
            'tempat_tinggal' => 'required',
            'kendaraan' => 'required',
            'hobi' => 'required',
            'kemampuan_english' => 'required',
            'kemampuan_komputer' => 'nullable',
            'kemampuan_khusus' => 'nullable',
            'aktifitas_sosial' => 'nullable',
            'riwayat_sakit' => 'nullable',
        ]);

        $userData = UsersData::where('user_id', $id)->first();
        // dd($userData);

        if ($userData) {

            $userData->update($validatedData);

            // $userData->info_lowongan = $validatedData['info_lowongan'];
            $userData->nama_panggilan = $validatedData['nama_panggilan'];
            $userData->tinggi_badan = $validatedData['tinggi_badan'];
            $userData->berat_badan = $validatedData['berat_badan'];
            $userData->status_kawin = $validatedData['status_kawin'];
            $userData->warga_negara = $validatedData['warga_negara'];
            $userData->jalan_ktp = $validatedData['jalan_ktp'];
            $userData->no_rumah_ktp = $validatedData['no_rumah_ktp'];
            $userData->rt_ktp = $validatedData['rt_ktp'];
            $userData->rw_ktp = $validatedData['rw_ktp'];
            $userData->kel_ktp = $validatedData['kel_ktp'];
            $userData->kec_ktp = $validatedData['kec_ktp'];
            $userData->kota_ktp = $validatedData['kota_ktp'];
            $userData->prov_ktp = $validatedData['prov_ktp'];
            $userData->kode_pos_ktp = $validatedData['kode_pos_ktp'];
            $userData->sama_dengan_ktp = $validatedData['sama_dengan_ktp'];
            $userData->jalan_domisili = $validatedData['jalan_domisili'];
            $userData->no_rumah_domisili = $validatedData['no_rumah_domisili'];
            $userData->rt_domisili = $validatedData['rt_domisili'];
            $userData->rw_domisili = $validatedData['rw_domisili'];
            $userData->kel_domisili = $validatedData['kel_domisili'];
            $userData->kec_domisili = $validatedData['kec_domisili'];
            $userData->kota_domisili = $validatedData['kota_domisili'];
            $userData->prov_domisili = $validatedData['prov_domisili'];
            $userData->kode_pos_domisili = $validatedData['kode_pos_domisili'];
            $userData->sim_a = $validatedData['sim_a'];
            $userData->sim_b = $validatedData['sim_b'];
            $userData->sim_c = $validatedData['sim_c'];
            $userData->tempat_tinggal = $validatedData['tempat_tinggal'];
            $userData->kendaraan = $validatedData['kendaraan'];
            $userData->hobi = $validatedData['hobi'];
            $userData->kemampuan_english = $validatedData['kemampuan_english'];
            $userData->kemampuan_komputer = $validatedData['kemampuan_komputer'];
            $userData->kemampuan_khusus = $validatedData['kemampuan_khusus'];
            $userData->aktifitas_sosial = $validatedData['aktifitas_sosial'];
            $userData->riwayat_sakit = $validatedData['riwayat_sakit'];
            $userData->form_interview = 'step_1';
            $userData->save();

            if ($userData->wasChanged()) {
                return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
            } else {
                return response()->json(['skip' => true, 'message' => 'No changes were made']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Data not found']);
        }
    }


    public function updateFamily(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'hubungan.*'            => 'required|string|max:300',
            'nama.*'                => 'required|string|max:300',
            'jenis_kelamin.*'       => 'required|string',
            'usia.*'         => 'required|numeric|min:0|max:200',
            'pendidikan_terakhir.*' => 'required|string|max:300',
            'pekerjaan.*'        => 'required|string|max:300',
            'perusahaan_tempat_kerja.*'  => 'required|string|max:300',
            'alamat.*'            => 'required|string|max:300',
            'nama_emergency'  => 'required|string|max:300',
            'no_hp_emergency'  => 'required|string|max:300',
            'hubungan_emergency'  => 'required|string|max:300',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validateData->errors()->all(),
                'message' => 'Validation failed'
            ]);
        }

        $familyIds = $request->input('family_ids', []);
        $namaArray = $request->input('nama', []);
        $hubunganArray = $request->input('hubungan', []);
        $jenisKelaminArray = $request->input('jenis_kelamin', []);
        $usiaArray = $request->input('usia', []);
        $pendidikanTerakhirArray = $request->input('pendidikan_terakhir', []);
        $pekerjaanArray = $request->input('pekerjaan', []);
        $perusahaanTempatKerjaArray = $request->input('perusahaan_tempat_kerja', []);
        $alamatArray = $request->input('alamat', []);

        foreach ($familyIds as $index => $familyId) {
            $nama = $namaArray[$index];
            $hubungan = $hubunganArray[$index];
            $jenisKelamin = $jenisKelaminArray[$index];
            $usia = $usiaArray[$index];
            $pendidikanTerakhir = $pendidikanTerakhirArray[$index];
            $pekerjaan = $pekerjaanArray[$index];
            $perusahaanTempatKerja = $perusahaanTempatKerjaArray[$index];
            $alamat = $alamatArray[$index];

            $data = [
                'user_id' => $id,
                'hubungan' => $hubungan,
                'nama' => $nama,
                'jenis_kelamin' => $jenisKelamin,
                'usia' => $usia,
                'pendidikan_terakhir' => $pendidikanTerakhir,
                'pekerjaan' => $pekerjaan,
                'perusahaan_tempat_kerja' => $perusahaanTempatKerja,
                'alamat' => $alamat
            ];

            if ($familyId) {
                UsersDataFamily::where('id', $familyId)->update($data);
                
                $userData = UsersData::where('user_id', $id)->first();
                $userData->nama_emergency = $request->input('nama_emergency');
                $userData->no_hp_emergency = $request->input('no_hp_emergency');
                $userData->hubungan_emergency = $request->input('hubungan_emergency');
                $userData->save();
            
            } else {
                UsersDataFamily::create($data);

                //update status from interview to completed in users data
                $userData = UsersData::where('user_id', $id)->first();
                $userData->form_interview = 'step_2';
                $userData->nama_emergency = $request->input('nama_emergency');
                $userData->no_hp_emergency = $request->input('no_hp_emergency');
                $userData->hubungan_emergency = $request->input('hubungan_emergency');
                $userData->save();
            }
        }

        $changed = false;

        foreach ($familyIds as $familyId) {
            // Assuming $familyId is a model instance
            $familyModel = UsersDataFamily::find($familyId); // Or however you retrieve your models
            if ($familyModel && $familyModel->wasChanged()) {
                $changed = true;
                break;
            }
        }

        if ($changed) {

            return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
        } else {
            return response()->json(['skip' => true, 'message' => 'No changes were made']);
        }
    }

    public function deleteFamily(Request $request)
    {
        $familyId = $request->input('id');

        if ($familyId) {
            UsersDataFamily::where('id', $familyId)->delete();
            return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid ID']);
        }
    }


    public function updateEducation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'instansi_sd' => 'required|string|max:255',
            'kota_sd' => 'required|string|max:50',
            'tahun_mulai_sd' => 'required|string',
            'tahun_selesai_sd' => 'required|string',
            'instansi_smp' => 'required|string|max:255',
            'kota_smp' => 'required|string|max:50',
            'tahun_mulai_smp' => 'required|integer',
            'tahun_selesai_smp' => 'required|integer',
            'instansi_sma' => 'nullable|string|max:255',
            'kota_sma' => 'nullable|string|max:50',
            'tahun_mulai_sma' => 'nullable|integer',
            'tahun_selesai_sma' => 'nullable|integer',
            'jurusan_sma' => 'nullable|string|max:255',
            'instansi_d3' => 'nullable|string|max:255',
            'kota_d3' => 'nullable|string|max:50',
            'tahun_mulai_d3' => 'nullable|integer',
            'tahun_selesai_d3' => 'nullable|integer',
            'jurusan_d3' => 'nullable|string|max:255',
            'instansi_s1' => 'nullable|string|max:255',
            'kota_s1' => 'nullable|string|max:50',
            'tahun_mulai_s1' => 'nullable|integer',
            'tahun_selesai_s1' => 'nullable|integer',
            'jurusan_s1' => 'nullable|string|max:255',
            'instansi_s2' => 'nullable|string|max:255',
            'kota_s2' => 'nullable|string|max:50',
            'tahun_mulai_s2' => 'nullable|integer',
            'tahun_selesai_s2' => 'nullable|integer',
            'jurusan_s2' => 'nullable|string|max:255',
            'instansi_s3' => 'nullable|string|max:255',
            'kota_s3' => 'nullable|string|max:50',
            'tahun_mulai_s3' => 'nullable|integer',
            'tahun_selesai_s3' => 'nullable|integer',
            'jurusan_s3' => 'nullable|string|max:255',
            'jenis_informal' => 'nullable|string|max:50',
            'judul_informal' => 'nullable|string|max:255',
            'penyelenggara_informal' => 'nullable|string|max:255',
            'kota_informal' => 'nullable|string|max:50',
            'durasi_informal' => 'nullable|string|max:50',
            'tahun_informal' => 'nullable|integer',
            'informal_dibiayai_oleh' => 'nullable|string|max:100',
        ]);

        $validatedData['user_id'] = $id; // Ensure the user_id is set

        $userDataEducation = UsersDataEducation::where('user_id', $id)->first();

        if ($userDataEducation) {
            $userDataEducation->update($validatedData);
            if ($userDataEducation->wasChanged()) {
                return response()->json(['success' => true, 'message' => 'Form updated successfully']);
            } else {
                return response()->json(['skip' => true, 'message' => 'No changes were made']);
            }
        } else {
            UsersDataEducation::create($validatedData);

            //update status from interview to completed in users data
            $userData = UsersData::where('user_id', $id)->first();
            $userData->form_interview = 'step_3';
            $userData->save();

            return response()->json(['success' => true, 'message' => 'Form created successfully']);
        }
    }


    public function updateEmploymentHistory(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'nama_perusahaan.*'            => 'required|string|max:300',
            'divisi.*'            => 'required|string|max:300',
            'jabatan.*'            => 'required|string|max:300',
            'nama_atasan.*'            => 'required|string|max:300',
            'jabatan_atasan.*'            => 'required|string|max:300',
            'tanggal_masuk.*'            => 'required|date',
            'tanggal_keluar.*'            => 'required|date',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validateData->errors()->all(),
                'message' => 'Validation failed'
            ]);
        }

        $EmploymentHistoryIDs = $request->input('employment_history_ids', []);
        $namaPerusahaanArray = $request->input('nama_perusahaan', []);
        $divisiArray = $request->input('divisi', []);
        $jabatanArray = $request->input('jabatan', []);
        $namaAtasanArray = $request->input('nama_atasan', []);
        $jabatanAtasanArray = $request->input('jabatan_atasan', []);
        $tanggalMasukArray = $request->input('tanggal_masuk', []);
        $tanggalKeluarArray = $request->input('tanggal_keluar', []);

        foreach ($EmploymentHistoryIDs as $index => $employmentHistoryId) {
            $namaPerusahaan = $namaPerusahaanArray[$index];
            $divisi = $divisiArray[$index];
            $jabatan = $jabatanArray[$index];
            $namaAtasan = $namaAtasanArray[$index];
            $jabatanAtasan = $jabatanAtasanArray[$index];
            $tanggalMasuk = $tanggalMasukArray[$index];
            $tanggalKeluar = $tanggalKeluarArray[$index];

            $data = [
                'user_id' => $id,
                'nama_perusahaan' => $namaPerusahaan,
                'divisi' => $divisi,
                'jabatan' => $jabatan,
                'nama_atasan' => $namaAtasan,
                'jabatan_atasan' => $jabatanAtasan,
                'tanggal_masuk' => $tanggalMasuk,
                'tanggal_keluar' => $tanggalKeluar,
            ];

            if ($employmentHistoryId) {
                UsersDataEmploymentHistory::where('id', $employmentHistoryId)->update($data);
            } else {
                UsersDataEmploymentHistory::create($data);

                //update status from interview to completed in users data
                $userData = UsersData::where('user_id', $id)->first();
                $userData->form_interview = 'step_4';
                $userData->save();
            }
        }




        $changed = false;

        foreach ($EmploymentHistoryIDs as $employmentHistoryId) {
            $employmentHistoryModel = UsersDataEmploymentHistory::find($employmentHistoryId);

            if ($employmentHistoryModel && $employmentHistoryModel->wasChanged()) {
                $changed = true;
                break;
            }
        }

        if ($changed) {
            return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
        } else {
            return response()->json(['skip' => true, 'message' => 'No changes were made']);
        }
    }

    public function deleteEmploymentHistory(Request $request)
    {
        $employmentHistoryId = $request->input('id');

        if ($employmentHistoryId) {
            UsersDataEmploymentHistory::where('id', $employmentHistoryId)->delete();
            return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid ID']);
        }
    }


    public function updateAnswer(Request $request, $id)
    {
        // Validate the input
        $validatedData = $request->validate([
            'answer' => 'required|array',
            'explain' => 'nullable|array',
        ]);

        // Get the authenticated user ID (assuming the user is logged in)
        $userID = $id; // Or use auth()->id() if the user is logged in

        // Loop through each question and save the answer
        foreach ($validatedData['answer'] as $questionID => $answer) {
            // Prepare the data for insertion
            $data = [
                'user_id' => $userID,
                'question_id' => $questionID,
                'answer' => $answer,
                'explain' => $validatedData['explain'][$questionID] ?? null,
            ];

            // Save or update the user's answer to the question
            UsersDataAnswer::updateOrCreate(
                ['user_id' => $userID, 'question_id' => $questionID],
                $data
            );
        }

        //update status from interview to completed in users data
        $userData = UsersData::where('user_id', $userID)->first();
        $userData->form_interview = 'completed';
        $userData->save();


        return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
    }
}
