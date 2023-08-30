<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\pelamars;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    //Pelamars
    public function index()
    {
        $pelamar = pelamars::paginate(10);

        return view('admin.pelamar', ['pelamar' => $pelamar]);
    }

    public function show($pelamar)
    {
        $result = pelamars::find($pelamar);
        return view('admin.detail', ['pelamar' => $result]);
    }

    public function contact()
    {
        $result = pelamars::all();
        return view('admin.contact', ['pelamar' => $result]);
    }

    public function cetak($pelamar)
    {
        $pelamar = pelamars::where('nik', $pelamar)->first();

        $pdf = PDF::loadView('admin.cetak', ['result' => $pelamar]);
        return $pdf->stream();
    }


    public function destroy($pelamar)
    {
        $pelamar = pelamars::where('id', $pelamar);
        $pelamar->delete();

        Alert::success('Sukses', 'Data berhasil di hapus');
        return redirect('/pelamars');
        // return redirect()->back()->with('sukses', 'data berhasil di hapus');
    }


    //Candidates
    public function index_candidate()
    {
        $candidate = Candidates::paginate(10);

        return view('admin.candidate', ['candidate' => $candidate]);
    }

    public function show_candidate($candidate)
    {
        $result = Candidates::find($candidate);
        return view('admin.detail', ['candidate' => $result]);
    }

    public function contact_candidate()
    {
        $result = Candidates::all();
        return view('admin.contact', ['candidate' => $result]);
    }

    public function cetak_candidate($candidate)
    {
        $candidate = Candidates::where('nik', $candidate)->first();

        $pdf = PDF::loadView('admin.cetak', ['result' => $candidate]);
        return $pdf->stream();
    }


    public function destroy_candidate($candidate)
    {
        $candidate = Candidates::where('id', $candidate);
        $candidate->delete();

        return redirect()->back()->with('sukses', 'data berhasil di hapus');
    }


    //Employee
    public function employee()
    {
        $result = Employee::all();
        return view('admin.employee', ['employee' => $result]);
    }
}
