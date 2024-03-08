<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\JobVacancies;
use App\Models\JobVacanciesActivity;
use App\Models\pelamars;
use App\Models\PelamarActivity;
use App\Models\User;
use App\Models\UsersData;
use App\Models\UsersData as ModelsUsersData;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        return view('form-data-pelamar', compact('cities'));
    }

    protected function store(Request $request)
    {
        $validateData = $request->validate([
            'nik'           =>  'required|min:14|max:16',
            'nama_lengkap'  =>  'required|string|max:300',
            'jenis_kelamin' =>  'required|in:P,L',
            'tempat_lahir'  =>  'required|string|',
            'tanggal_lahir' =>  'required|date',
            'agama'         =>  'required|string|',
            'alamat'        =>  'required|string',
            'pref_location' =>  'required|string',
            'email'         =>  'required|string|email|max:255',
            'no_hp'         =>  'required',
            'pendidikan_terakhir'   => 'required',
            'jurusan'       =>  'required',
            'institusi'       =>  'required',
            'nilai'       =>  'required',
            'upload_foto'    => 'required|file|image|max:6000',
            'upload_file'   =>  'required|file|max:6000',
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
            $request->file('upload_foto')->move('uploads/images', $namaImage);
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
            $request->file('upload_file')->move('uploads/files', $namaFile);
        }

        // Store the form data in the session
        // $request->session()->put('application_data', $request->except(['_token']));

        //Input Database
        $profiles = new usersData();
        $profiles->user_id = auth()->user()->id;
        $profiles->nik = $validateData['nik'];
        $profiles->nama_lengkap = $validateData['nama_lengkap'];
        $profiles->jenis_kelamin = $validateData['jenis_kelamin'];
        $profiles->tempat_lahir = $validateData['tempat_lahir'];
        $profiles->tanggal_lahir = $validateData['tanggal_lahir'];
        $profiles->agama = $validateData['agama'];
        $profiles->alamat = $validateData['alamat'];
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
            Alert::success('Sukses !', 'Data anda berhasil tersimpan');
            return redirect('/detail-login-user');
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
            'nik'           =>  'required|min:14|max:16',
            'nama_lengkap'  =>  'required|string|max:300',
            'jenis_kelamin' =>  'required|in:P,L',
            'tempat_lahir'  =>  'required|string|',
            'tanggal_lahir' =>  'required|date',
            'agama'         =>  'required|string|',
            'alamat'        =>  'required|string',
            'pref_location' =>  'required|string',
            'email'         =>  'required|string|email|max:255',
            'no_hp'         =>  'required',
            'pendidikan_terakhir'   => 'required',
            'jurusan'       =>  'required',
            'institusi'       =>  'required',
            'nilai'       =>  'required',
            'upload_foto'    => 'file|image|max:6000',
            'upload_file'   =>  'file|max:6000',
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
            $request->file('upload_foto')->move('uploads/images', $namaImage);
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
            $request->file('upload_file')->move('uploads/files', $namaFile);
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
        $profiles->alamat = $validateData['alamat'];
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
            Alert::success('Sukses !', 'Data anda berhasil tersimpan');
            return redirect('/detail-login-user');
        }
        if ($validateData->fails()) {
            return redirect('/detail-login-user')
                ->withErrors($validateData)
                ->withInput();
        }
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

        if ($user) {

            $pelamars = pelamars::all();
            return view('user.detail-profile', compact('pelamars'));
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
        $minat_karir = pelamars::select('minat_karir')->where('id', $id)->first();
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
        // dd($jobActivities);
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
