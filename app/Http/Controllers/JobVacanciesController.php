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
        // dd($request->all());
        $request->validate([
            'job_title' => 'required|max:255',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'job_location' => 'required|min:1|array',
            'job_branch' => 'required|min:1|array',
            'job_company' => 'required|max:50'

        ]);

        // JobVacancies::create($validatedData);

        $vacancy = new JobVacancies();
        $vacancy->job_title = $request->job_title;
        $vacancy->job_description = $request->job_description;
        $vacancy->job_requirement = $request->job_requirement;
        $vacancy->job_company = $request->job_company;
        $vacancy->job_location = implode(",", $request->job_location);
        $vacancy->job_branch = implode(",", $request->job_branch);

        if ($vacancy->save()) {
            Alert::success('success', 'Job vacancy added successfully!');
        } else {
            Alert::error('Failed', 'Job vacancy failed !');
        }

        return redirect('/vacancies');
    }




    public function show($vacancies)
    {
        $result = JobVacancies::find($vacancies);
        return view('admin.job-vacancies.detail', ['vacancies' => $result]);
    }


    public function edit($vacancies)
    {
        $result = JobVacancies::find($vacancies);
        return view('admin.job-vacancies.edit', ['vacancies' => $result]);
    }


    // public function update(Request $request, $vacancies)
    // {
    //     dd($request->all());
    //     $request->validate([
    //         'job_title' => 'required',
    //         'job_title' => 'required|max:255',
    //         'job_description' => 'required',
    //         'job_requirement' => 'required',
    //         'job_location' => 'required|min:1|array',
    //         'job_branch' => 'required|min:1|array',
    //         'job_company' => 'required|max:50'
    //         // Add validation rules for other fields
    //     ]);

    //     $vacancy = JobVacancies::findOrFail($vacancies);
    //     $vacancy->update($request->all());

    //     return redirect()->route('vacancies.index')->with('success', 'Job Vacancy updated successfully');
    // }

    public function update(Request $request, $vacancies)
    {
        // dd($request->all());
        $request->validate([
            'job_title' => 'required|max:255',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'job_location' => 'required|min:1|array',
            'job_branch' => 'required|min:1|array',
            'job_company' => 'required|max:50',

        ]);

        $vacancy = JobVacancies::find($vacancies);
        $vacancy->job_title = $request->job_title;
        $vacancy->job_description = $request->job_description;
        $vacancy->job_requirement = $request->job_requirement;
        $vacancy->job_company = $request->job_company;
        $vacancy->job_location = implode(",", $request->job_location);
        $vacancy->job_branch = implode(",", $request->job_branch);

        if ($vacancy->save()) {
            Alert::success('success', 'Job vacancy updated successfully!');
        } else {
            Alert::error('Failed', 'Job vacancy update failed !');
        }

        return redirect('/vacancies');
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
