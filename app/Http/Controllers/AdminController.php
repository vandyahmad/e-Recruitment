<?php

namespace App\Http\Controllers;

use App\Mail\PelamarNotification;
use App\Models\Candidates;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\pelamars;
use App\Models\PelamarActivity;
use App\Models\UsersData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    //Pelamars
    public function index_pelamar(Request $request)
    {
        // $page = $request->query('page');
        $search = $request->query('search');
        // dd($search);

        $pelamar = pelamars::with('activities', 'job_vacancy', 'userData');
        // if($search) {
        //     $pelamar = $pelamar->where('userData.nama_lengkap', 'LIKE' , '%' .$search. '%');
        // }
        $pelamar = $pelamar->get();

        // dd($pelamar);

        // dd($pelamar[0]->userData->nama_lengkap);
        // $activitySteps = DB::table('activity_steps')->get();
        $activitySteps = DB::select(DB::raw("
        SELECT
            jva.`sequence`
            ,jva.job_vacancy_id
            ,jva.activity_step_id
            ,jv.id
            ,ac.name
        FROM job_vacancies_activity jva
        LEFT OUTER JOIN job_vacancies jv ON jv.id = jva.job_vacancy_id
        LEFT OUTER JOIN activity_steps ac ON ac.id = jva.activity_step_id
        order by 1
        "));
        // dd($results);
        return view('admin.pelamar', [
            'pelamar' => $pelamar,
            'activitySteps' => $activitySteps,
            // 'profile' => $profile,
        ]);
    }

    public function show_pelamar($pelamar)
    {
        $result = pelamars::with('userData', 'job_vacancy')->find($pelamar);
        return view('admin.detail', ['pelamar' => $result]);
    }

    public function cetak_pelamar($pelamar)
    {
        $result = pelamars::with('userData', 'job_vacancy')->where('id',$pelamar)->first();
        // dd($result);
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
        $request->validate([
            'activity' => 'required',
            'jadwal_activity' => 'required',
            'lokasi_activity' => 'required',
            'keterangan' => 'required',
        ]);

        // Simpan data ke database (gantilah dengan model Anda)
        $data = new PelamarActivity(); // Gantilah dengan model Anda
        $data->id_pelamar = $request->input('pelamarID');
        $data->activity = $request->input('activity');
        $data->jadwal_activity = $request->input('jadwal_activity');
        $data->lokasi_activity = $request->input('lokasi_activity');
        $data->keterangan = $request->input('keterangan');
        $data->save();

        $update = pelamars::find($request->input('pelamarID'));
        $update->status = $request->input('activity');
        $update->save();


        $pelamar = pelamars::with('activities', 'job_vacancy', 'userData')->leftJoin('job_vacancies as jv', 'jv.id', '=', 'pelamars.minat_karir')->find($request->input('pelamarID'));
        $nama = $pelamar->userData->nama_lengkap;
        $status = $pelamar->status;
        $minat = $pelamar->job_title;

        $pelamar_activity = PelamarActivity::find($data->id);
        $this_activity = $pelamar_activity->activity;
        $lokasi = $pelamar_activity->lokasi_activity;
        $jadwal = $pelamar_activity->jadwal_activity;
        $keterangan = $pelamar_activity->keterangan;

        try {
            Mail::to($pelamar->userData->email)->send(new PelamarNotification($nama, $status, $minat, $this_activity, $lokasi, $jadwal, $keterangan, $request->input('pelamarID')));

            // Update email_sent_at only if the email was sent successfully
            $update_email = PelamarActivity::find($data->id);
            $update_email->email_sent_at = now();
            $update_email->save();

            Alert::success('Sukses', 'Data berhasil di proses, email sent');

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            Alert::error('Error', 'Failed to send email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.'
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
