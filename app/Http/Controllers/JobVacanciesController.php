<?php

namespace App\Http\Controllers;

use App\Models\JobVacancies;
use Illuminate\Http\Request;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class JobVacanciesController extends Controller
{

    public function index()
    {
        // Retrieve all job vacancies
        $result = JobVacancies::all();
        return view('admin.job-vacancies.index', ['jobvacancies' => $result]);
    }


    public function create()
    {
        return view('admin.job-vacancies.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_title' => 'required|max:255',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'job_location' => 'required|max:255',
            'job_company' => 'required|max:50',
            'job_branch' => 'required|max:30',
        ]);

        JobVacancies::create($validatedData);

        Alert::success('success', 'Job vacancy added successfully!');
        return redirect('/vacancies');
    }


    public function show($vacancies)
    {
        $result = JobVacancies::find($vacancies);
        return view('admin.job-vacancies.detail', ['vacancies' => $result]);
    }


    public function destroy($vacancies)
    {
        $vacancies = JobVacancies::where('id', $vacancies);
        $vacancies->delete();
        Alert::success('Sukses', 'Data berhasil di hapus');
        return redirect('/vacancies');
        // return redirect()->back()->with('sukses', 'data berhasil di hapus');

        
    }
}
