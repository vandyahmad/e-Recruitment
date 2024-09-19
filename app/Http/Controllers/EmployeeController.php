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
use App\Models\UsersData as ModelsUsersData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    // public function index()
    // {
    //     // $pelamar = pelamars::all();
    //     // return view('admin.pelamar', compact('pelamar'));

    // }

    // protected function store(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'nik'           =>  'required|min:14|max:16|unique:users_data',
    //         'nama_lengkap'  =>  'required|string|max:300',
    //         'jenis_kelamin' =>  'required|in:P,L',
    //         'tempat_lahir'  =>  'required|string',
    //         'tanggal_lahir' =>  'required|date',
    //         'agama'         =>  'required|string',
    //         'alamat'        =>  'required|string',
    //         'pref_location' =>  'required|string',
    //         'email'         =>  'required|string|email|max:50',
    //         'no_hp'         =>  'required',
    //         'pendidikan_terakhir'   => 'required',
    //         'jurusan'       =>  'required',
    //         'institusi'       =>  'required',
    //         'nilai'       =>  'required',
    //         'upload_foto'    => 'required|file|image|max:20000',
    //         'upload_file'   =>  'required|file|mimes:pdf|max:20000',
    //     ]);


    //     //Mengambil request object untuk proses upload file
    //     $request = request();


    //     //Proses Upload file gambar profil
    //     if ($request->hasFile('upload_foto')) {
    //         //Menggunakan slug helper agar "nama" bisa di pakai sebagai bagian  dari nama gambar_profil
    //         $slug = str::slug($request['nama_lengkap']);

    //         // Mengambil extensi file asli
    //         $extImage = $request->upload_foto->getClientOriginalExtension();

    //         // Generate nama_gambar, gabungan dari slug "nama" + time() + extensi file
    //         $namaImage = $slug . '-' . time() . "." . $extImage;

    //         // Proses Upload, simpan ke dalam folder "uploads"
    //         $request->file('upload_foto')->move('public/uploads/images', $namaImage);
    //     } else {
    //         //Jika User tidak mengupload gambar, isi dengan gambar default
    //         $namaImage = 'default_profile.jpg';
    //     }

    //     //proses Upload File
    //     $namaFile = '';
    //     if ($request->hasFile('upload_file')) {
    //         //Slug
    //         $slug = Str::slug($request['nama_lengkap']);
    //         //Extensi
    //         $extFile = $request->upload_file->getClientOriginalExtension();
    //         //generate
    //         $namaFile = $slug . '-' . time() . "." . $extFile;
    //         //Proses Upload
    //         $request->file('upload_file')->move('public/uploads/files', $namaFile);
    //     }

    //     // Store the form data in the session
    //     // $request->session()->put('application_data', $request->except(['_token']));

    //     //Input Database
    //     $tanggal_lahir = \Carbon\Carbon::createFromFormat('d-m-Y', $validateData['tanggal_lahir'])->format('Y-m-d');
    //     $profiles = new usersData();
    //     $profiles->user_id = auth()->user()->id;
    //     $profiles->nik = $validateData['nik'];
    //     $profiles->nama_lengkap = $validateData['nama_lengkap'];
    //     $profiles->jenis_kelamin = $validateData['jenis_kelamin'];
    //     $profiles->tempat_lahir = $validateData['tempat_lahir'];
    //     $profiles->tanggal_lahir = $tanggal_lahir;
    //     $profiles->agama = $validateData['agama'];
    //     $profiles->alamat = $validateData['alamat'];
    //     $profiles->pref_location = $validateData['pref_location'];
    //     $profiles->email = $validateData['email'];
    //     $profiles->no_hp = $validateData['no_hp'];
    //     $profiles->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
    //     $profiles->jurusan = $validateData['jurusan'];
    //     $profiles->institusi = $validateData['institusi'];
    //     $profiles->nilai = str_replace(',', '.', $validateData['nilai']);
    //     $profiles->upload_foto = $namaImage;
    //     $profiles->upload_file = $namaFile;
    //     $profiles->save();

    //     if ($profiles) {
    //         Alert::success('Sukses!', 'Data Anda berhasil disimpan!');
    //         return redirect('/detail-login-user');
    //     }
    //     if ($validateData->fails()) {
    //         return redirect('/form-data-pelamar')
    //             ->withErrors($validateData)
    //             ->withInput();
    //     }

    //     // $now = Carbon::now();

    //     // // Filter job vacancies with end dates in the future
    //     // $jobVacancies = JobVacancy::where('job_end_date', '>=', $now)->get();

    //     // return view('your_view', ['jobVacancies' => $jobVacancies]);
    // }

    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'nama_lengkap'  =>  'required|string|max:300',
            'nik'           =>  'required|min:14|max:16',
            'jenis_kelamin' =>  'required|in:P,L',
            'tempat_lahir'  =>  'required|string|',
            'tanggal_lahir' =>  'required|date',
            'status_kawin'  =>  'required|string|',
            'status_ptkp'   =>  'required|string|',
            'agama'         =>  'required|string|',
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
            'email'         =>  'required|string|email|max:255',
            'no_hp'         =>  'required',
            'gol_darah'     =>  'required|string|',
            'no_kk'         =>  'required',
            'no_npwp'       =>  'required',
            'no_bpjs_kesehatan' =>  'required',
            'no_bpjs_ketenagakerjaan' =>  'required',
            'sim_a' => 'nullable|string|min:14|max:16',
            'sim_b' => 'nullable|string|min:14|max:16',
            'sim_c' => 'nullable|string|min:14|max:16',
            'nama_bank'     =>  'required|string|',
            'no_rekening'   =>  'required',
            'nama_rekening' =>  'required|string|',
            'pendidikan_terakhir'   => 'required',
            'jurusan'       =>  'required',
            'institusi'       =>  'required',
            'nilai'       =>  'required',
            'upload_foto'    => 'file|image|max:20000',
            'upload_file'   =>  'file|mimes:pdf|max:20000',
        ]);


        if ($validateData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validateData->errors()->toArray(),
                'message' => 'Validation failed'
            ]);
        }

        //Mengambil request object untuk proses upload file
        $request = request();


        $profiles = Employee::where('user_id', $id)->first();
        // dd($profiles);

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


        //UPdate Database

        $profiles->user_id = auth()->user()->id;
        $profiles->nama_lengkap = $request->input('nama_lengkap');
        $profiles->nik = $request->input('nik');
        $profiles->tempat_lahir = $request->input('tempat_lahir');
        $profiles->tanggal_lahir = $request->input('tanggal_lahir');
        $profiles->agama = $request->input('agama');
        $profiles->jenis_kelamin = $request->input('jenis_kelamin');
        $profiles->status_kawin = $request->input('status_kawin');
        $profiles->status_ptkp = $request->input('status_ptkp');
        $profiles->gol_darah = $request->input('gol_darah');
        $profiles->jalan_ktp = $request->input('jalan_ktp');
        $profiles->no_rumah_ktp = $request->input('no_rumah_ktp');
        $profiles->rt_ktp = $request->input('rt_ktp');
        $profiles->rw_ktp = $request->input('rw_ktp');
        $profiles->kel_ktp = $request->input('kel_ktp');
        $profiles->kec_ktp = $request->input('kec_ktp');
        $profiles->kota_ktp = $request->input('kota_ktp');
        $profiles->prov_ktp = $request->input('prov_ktp');
        $profiles->kode_pos_ktp = $request->input('kode_pos_ktp');
        $profiles->sama_dengan_ktp = $request->input('sama_dengan_ktp');
        $profiles->jalan_domisili = $request->input('jalan_domisili');
        $profiles->no_rumah_domisili = $request->input('no_rumah_domisili');
        $profiles->rt_domisili = $request->input('rt_domisili');
        $profiles->rw_domisili = $request->input('rw_domisili');
        $profiles->kel_domisili = $request->input('kel_domisili');
        $profiles->kec_domisili = $request->input('kec_domisili');
        $profiles->kota_domisili = $request->input('kota_domisili');
        $profiles->prov_domisili = $request->input('prov_domisili');
        $profiles->kode_pos_domisili = $request->input('kode_pos_domisili');
        $profiles->email = $request->input('email');
        $profiles->no_hp = $request->input('no_hp');
        $profiles->no_kk = $request->input('no_kk');
        $profiles->no_npwp = $request->input('no_npwp');
        $profiles->no_bpjs_kesehatan = $request->input('no_bpjs_kesehatan');
        $profiles->no_bpjs_ketenagakerjaan = $request->input('no_bpjs_ketenagakerjaan');
        $profiles->sim_a = $request->input('sim_a');
        $profiles->sim_b = $request->input('sim_b');
        $profiles->sim_c = $request->input('sim_c');
        $profiles->nama_bank = $request->input('nama_bank');
        $profiles->no_rekening = $request->input('no_rekening');
        $profiles->nama_rekening = $request->input('nama_rekening');
        $profiles->pendidikan_terakhir = $request->input('pendidikan_terakhir');
        $profiles->jurusan = $request->input('jurusan');
        $profiles->institusi = $request->input('institusi');
        $profiles->nilai = str_replace(',', '.', $request->input('nilai'));
        $profiles->upload_foto = $namaImage;
        $profiles->upload_file = $namaFile;
        $profiles->save();


        // if ($profiles) {
        //     Alert::success('Sukses!', 'Data Anda berhasil diupdate!');
        //     return redirect('/detail-login-user');
        // }


        return response()->json([
            'success' => true, // or false based on whether the update was successful
            'message' => 'Data Anda berhasil diupdate!' // Optional message to display
        ]);
    }


    public function updateFamily(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'hubungan_fam.*'             => 'required|string|max:300',
            'nama_fam.*'                 => 'required|string|max:300',
            'usia_fam.*'                 => 'required|numeric',
            'jenis_kelamin_fam.*'        => 'required|string',
            'pendidikan_terakhir_fam.*'  => 'string|nullable',
            'pekerjaan_fam.*'            => 'string|nullable',
            'perusahaan_tempat_kerja_fam.*' => 'string|nullable',
            'alamat_fam.*'               => 'string|nullable',
            // 'nik_fam.*'                  => 'required|min:14|max:16',
            // 'tempat_lahir_fam.*'         => 'required|string',
            // 'tanggal_lahir_fam.*'        => 'required|date',
            // 'emergency_contact.*'        => 'required',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validateData->errors()->all(),
                'message' => 'Validation failed'
            ]);
        }

        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ]);
        }

        $familyIds = $request->input('family_ids', []);
        $namaArray = $request->input('nama_fam', []);
        $hubunganArray = $request->input('hubungan_fam', []);
        $usiaArray = $request->input('usia_fam', []);
        $jenisKelaminArray = $request->input('jenis_kelamin_fam', []);
        $pendidikanArray = $request->input('pendidikan_terakhir_fam', []);
        $pekerjaanArray = $request->input('pekerjaan_fam', []);
        $perusahaanTempatKerjaArray = $request->input('perusahaan_tempat_kerja_fam', []);
        $alamatArray = $request->input('alamat_fam', []);

        // $nikArray = $request->input('nik_fam', []);
        // $tempatLahirArray = $request->input('tempat_lahir_fam', []);
        // $tanggalLahirArray = $request->input('tanggal_lahir_fam', []);
        // $emergencyContactIndex = $request->input('emergency_contact');

        // Reset all emergency contacts to "no" for this employee
        EmployeeFamily::where('employee_id', $employee->id)->update(['emergency_contact' => 'no']);

        foreach ($namaArray as $index => $nama) {
            $familyId = $familyIds[$index] ?? null;
            $hubungan = $hubunganArray[$index] ?? null;
            $usia = $usiaArray[$index] ?? null;
            $jenisKelamin = $jenisKelaminArray[$index] ?? null;
            $pendidikan = $pendidikanArray[$index] ?? null;
            $pekerjaan = $pekerjaanArray[$index] ?? null;
            $perusahaanTempatKerja = $perusahaanTempatKerjaArray[$index] ?? null;
            $alamat = $alamatArray[$index] ?? null;
            // $nik = $nikArray[$index] ?? null;
            // $tempatLahir = $tempatLahirArray[$index] ?? null;
            // $tanggalLahir = $tanggalLahirArray[$index] ?? null;
            // $emergencyContact = $index == $emergencyContactIndex ? 'yes' : 'no';

            $data = [
                'employee_id' => $employee->id,
                'nama_fam' => $nama,
                'hubungan_fam' => $hubungan,
                'usia_fam' => $usia,
                'jenis_kelamin_fam' => $jenisKelamin,
                'pendidikan_terakhir_fam' => $pendidikan,
                'pekerjaan_fam' => $pekerjaan,
                'perusahaan_tempat_kerja_fam' => $perusahaanTempatKerja,
                'alamat_fam' => $alamat,
                // 'nik_fam' => $nik,
                // 'tempat_lahir_fam' => $tempatLahir,
                // 'tanggal_lahir_fam' => $tanggalLahir,
                // 'emergency_contact' => $emergencyContact
            ];

            if ($familyId) {
                $employeeFamily = EmployeeFamily::find($familyId);
                if ($employeeFamily) {
                    $employeeFamily->update($data);
                }
            } else {
                EmployeeFamily::create($data);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data keluarga berhasil diupdate!'
        ]);
    }

    public function updateDocument(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ]);
        }

        $employeeDocument = EmployeeDocument::where('employee_id', $employee->id)->first();
        if (!$employeeDocument) {
            $employeeDocument = new EmployeeDocument();
            $employeeDocument->employee_id = $employee->id;
        }

        // Build the validation rules
        $validationRules = [
            'doc_ktp' => 'required_without:existing_doc_ktp|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_npwp' => 'required_without:existing_doc_npwp|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_kk' => 'required_without:existing_doc_kk|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_sim' => 'required_without:existing_doc_sim|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_buku_rekening' => 'required_without:existing_doc_buku_rekening|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_ijazah_terakhir' => 'required_without:existing_doc_ijazah_terakhir|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_transkrip_nilai' => 'required_without:existing_doc_transkrip_nilai|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_paklaring' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_bpjs_kesehatan' => 'required_without:existing_doc_bpjs_kesehatan|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_bpjs_ketenagakerjaan' => 'required_without:existing_doc_bpjs_ketenagakerjaan|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_surat_nikah' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_surat_vaksin' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_akta_kelahiran_anak_1' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_akta_kelahiran_anak_2' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'doc_akta_kelahiran_anak_3' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];

        // Append the existing document names to the request for validation purposes
        $request->merge([
            'existing_doc_ktp' => $employeeDocument->doc_ktp,
            'existing_doc_npwp' => $employeeDocument->doc_npwp,
            'existing_doc_kk' => $employeeDocument->doc_kk,
            'existing_doc_sim' => $employeeDocument->doc_sim,
            'existing_doc_buku_rekening' => $employeeDocument->doc_buku_rekening,
            'existing_doc_ijazah_terakhir' => $employeeDocument->doc_ijazah_terakhir,
            'existing_doc_transkrip_nilai' => $employeeDocument->doc_transkrip_nilai,
            'existing_doc_bpjs_kesehatan' => $employeeDocument->doc_bpjs_kesehatan,
            'existing_doc_bpjs_ketenagakerjaan' => $employeeDocument->doc_bpjs_ketenagakerjaan,
        ]);

        $validateData = Validator::make($request->all(), $validationRules);

        if ($validateData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validateData->errors()->toArray(),
                'message' => 'Validation failed'
            ]);
        }

        // Function to handle file uploads
        function handleFileUpload($request, $employee, $fieldName, &$employeeDocument, $filePrefix)
        {
            if ($request->hasFile($fieldName)) {
                $uploadedFile = $request->file($fieldName);
                $extFile = $uploadedFile->getClientOriginalExtension();
                $employeeName = Str::slug($employee->nama_lengkap);
                $fileName = $filePrefix . '-' . $employeeName . '-' . time() . '.' . $extFile;
                $uploadedFile->move(public_path('uploads/files'), $fileName);
                $employeeDocument->$fieldName = $fileName;
                return true;
            }
            return false;
        }

        // Fields to be handled
        $fields = [
            'doc_ktp' => 'ktp',
            'doc_npwp' => 'npwp',
            'doc_kk' => 'kk',
            'doc_sim' => 'sim',
            'doc_buku_rekening' => 'tabungan',
            'doc_ijazah_terakhir' => 'ijazah',
            'doc_transkrip_nilai' => 'transkrip_nilai',
            'doc_paklaring' => 'paklaring',
            'doc_bpjs_kesehatan' => 'bpjs_kesehatan',
            'doc_bpjs_ketenagakerjaan' => 'bpjs_ketenagakerjaan',
            'doc_surat_nikah' => 'surat_nikah',
            'doc_surat_vaksin' => 'surat_vaksin',
            'doc_akta_kelahiran_anak_1' => 'akta_kelahiran_anak_1',
            'doc_akta_kelahiran_anak_2' => 'akta_kelahiran_anak_2',
            'doc_akta_kelahiran_anak_3' => 'akta_kelahiran_anak_3'
        ];

        $hasUploadedFile = false;
        foreach ($fields as $field => $prefix) {
            $hasUploadedFile = handleFileUpload($request, $employee, $field, $employeeDocument, $prefix) || $hasUploadedFile;
        }

        if ($hasUploadedFile) {
            $employeeDocument->save();

            return response()->json([
                'success' => true,
                'message' => 'Documents uploaded/updated successfully.'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'No documents updated, skipping upload.'
            ]);
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
}
