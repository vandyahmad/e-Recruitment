<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CandidatesController extends Controller
{
    public function index()
    {
        $candidate = Candidates::paginate(10);

        return view('candidates.show', ['candidate' => $candidate]);
    }

    public function create()
    {
        return view('form-pendaftaran');
    }

    protected function store(Request $request)
    {
        $validateData = $request->validate([
            'nik'           =>  'required|min:14|max:16',
            'nama_lengkap'  =>  'required|string|max:300',
            'nama_panggilan'  =>  'required|string|max:300',
            'tempat_lahir'  =>  'required|string',
            'tanggal_lahir' =>  'required|date',
            'jenis_kelamin' =>  'required|in:P,L',
            'agama'         =>  'required|string',
            'kewarganegaraan' =>  'required|string',
            'status_kawin'  =>  'required|string',
            'tinggi_badan'  =>  'required', 
            'berat_badan'   =>  'required',
            'hobi'          =>  'required',
            // 'alamat'        =>  'required|string',
            // 'email'         =>  'required|string|email|max:255|unique:Candidates',
            // 'no_hp'         =>  'required',
            // 'pendidikan_terakhir'   => 'required',
            // 'minat_karir'   =>  'required',
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
            $extFile = $request->upload_foto->getClientOriginalExtension();

            // Generate nama_gambar, gabungan dari slug "nama" + time() + extensi file
            $namaImage = $slug . '-' . time() . "." . $extFile;

            // Proses Upload, simpan ke dalam folder "uploads"
            $request->upload_foto->storeAs('public/uploads/images', $namaImage);
        } else {
            //Jika User tidak mengupload gambar, isi dengan gambar default
            $namaImage = 'default_profile.jpg';
        }

        //proses Upload File
        if ($request->hasFile('upload_file')) {
            //Slug
            $slug = Str::slug($request['nama_lengkap']);
            //Extensi
            $extFile = $request->upload_file->getClientOriginalExtension();
            //generate
            $namaFile = $slug . '.' . time() . "." . $extFile;
            //Proses Upload
            $request->upload_file->storeAs('public/uploads/files', $namaFile);
        }

        //Input Database
        $Candidates = new Candidates();
        $Candidates->nik = $validateData['nik'];
        $Candidates->nama_lengkap = $validateData['nama_lengkap'];
        $Candidates->tempat_lahir = $validateData['tempat_lahir'];
        $Candidates->tanggal_lahir = $validateData['tanggal_lahir'];
        $Candidates->jenis_kelamin = $validateData['jenis_kelamin'];
        $Candidates->agama = $validateData['agama'];
        $Candidates->kewarganegaraan = $validateData['kewarganegaraan'];
        $Candidates->status_kawin = $validateData['status_kawin'];
        $Candidates->tinggi_badan = $validateData['tinggi_badan'];
        $Candidates->berat_badan = $validateData['berat_badan'];
        $Candidates->hobi = $validateData['hobi'];
        // $Candidates->alamat = $validateData['alamat'];
        // $Candidates->email = $validateData['email'];
        // $Candidates->no_hp = $validateData['no_hp'];
        // $Candidates->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
        // $Candidates->minat_karir = $validateData['minat_karir'];
        $Candidates->upload_foto = $namaImage;
        $Candidates->upload_file = $namaFile;
        $Candidates->save();

        if ($Candidates) {
            Alert::success('Pendaftaran Berhasil', 'Untuk Selanjutnya Admin Akan Menghubungi Lewat Email/Whatsapp.');
            return redirect('/form-pendaftaran');
        }
        if ($validateData->fails()) {
            return redirect('/form-pendaftaran')
                ->withErrors($validateData)
                ->withInput();
        }
    }
    // public function show(Candidates $Candidates)
    // {
    //     $detail_pelamar = Candidates::where('nik', $Candidates);
    //     $detail_pelamar->first();

    //     return view('admin.detail', ['detail_pelamar' => $Candidates]);
    // }

    public function edit(Candidates $Candidates)
    {
        //
    }

    public function update(Request $request, Candidates $Candidates)
    {
        //
    }

    // public function destroy($nik)
    // {
    //     $candidate = Candidates::where('nik', $nik);
    //     $candidate->delete();

    //     return redirect()->back()->with('sukses', 'data berhasil di hapus');
    // }
}
