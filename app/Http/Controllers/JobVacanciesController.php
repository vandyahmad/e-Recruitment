<?php

namespace App\Http\Controllers;

use App\Models\ActivityStep;
use App\Models\JobVacancies;
use App\Models\JobVacanciesActivity;
use App\Models\pelamars;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class JobVacanciesController extends Controller
{

    public function index()
    {
        // Retrieve all job vacancies
        $results = JobVacancies::with('pelamar')->get();


        return view('admin.job-vacancies.index', ['jobvacancies' => $results, 'vacancies' => []]);
    }


    public function create()
    {
        $cities = City::all();
        return view('admin.job-vacancies.create', compact('cities'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'job_title' => 'required|max:255',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'job_location' => 'required|min:1|array',
            // 'job_branch' => 'required|min:1|array',
            'job_company' => 'required',
            'job_functional' => 'required',
            'job_level' => 'required',
            'job_type' => 'required',
            'job_start_date' => 'required',
            'job_end_date' => 'required',
        ]);

        // JobVacancies::create($validatedData);

        $vacancy = new JobVacancies();
        $vacancy->job_title = $request->job_title;
        $vacancy->job_description = $request->job_description;
        $vacancy->job_requirement = $request->job_requirement;
        $vacancy->job_company = $request->job_company;
        $vacancy->job_functional = $request->job_functional;
        $vacancy->job_level = $request->job_level;
        $vacancy->job_type = $request->job_type;
        $vacancy->job_location = implode(",", $request->job_location);
        // $vacancy->job_branch = implode(",", $request->job_branch);
        $vacancy->job_start_date = $request->job_start_date;
        $vacancy->job_end_date = $request->job_end_date;

        if ($vacancy->save()) {
            return redirect()->route('vacancies.step', $vacancy->id);
        } else {
            Alert::error('Failed', 'Job vacancy failed !');
            return redirect()->route('vacancies.create');
        }
    }


    public function step($id)
    {
        $job_vacancies = JobVacancies::find($id);
        $activity_steps = ActivityStep::all();
        // dd($activity_steps);
        // Validate the input
        // $request->validate([
        //     'job_title' => 'required|max:255',
        //     'job_description' => 'required',
        //     'job_requirement' => 'required',
        //     'job_location' => 'required|array|min:1',
        //     'job_branch' => 'required|array|min:1',
        //     'job_company' => 'required|max:50',
        //     'job_start_date' => 'required',
        //     'job_end_date' => 'required',
        // ]);

        // return view('admin.job-vacancies.step', ['vacancies' => $result]);
        return view('admin.job-vacancies.step', compact('job_vacancies', 'activity_steps', 'id'));
    }

    public function step_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'application_step_no' => 'required|array',
            'application_step' => 'required|array',
            // Add more validation rules for your step data
        ]);

        // Process and save the step data to your database
        $stepData = $request->only('application_step_no', 'application_step', 'job_vacancy_id');

        foreach ($stepData['application_step_no'] as $key => $stepNo) {
            JobVacanciesActivity::create([
                'sequence' => $stepData['application_step_no'][$key],
                'activity_step_id' => $stepData['application_step'][$key],
                'job_vacancy_id' => $stepData['job_vacancy_id'],
                // Add more columns if you have additional fields
            ]);
        }

        // JobVacancies::create($validatedData);



        // if ($vacancy->save()) {
        Alert::success('success', 'Job vacancy added successfully!');
        // } else {
        //     Alert::error('Failed', 'Job vacancy failed !');
        // }

        return redirect()->route('vacancies.index');
    }


    public function show($vacancies)
    {
        $result = JobVacancies::find($vacancies);
        return view('admin.job-vacancies.detail', ['vacancies' => $result]);
    }


    public function pelamar($vacancies)
    {
        $applicants = Pelamars::with('activities', 'job_vacancy', 'userData')->where('minat_karir', $vacancies)->get();
        // dd($applicants);

        // if ($applicants->isEmpty()) {
        //     // Handle the case when no applicants are found, you might want to redirect or display a message
        //     Alert::error('Empty', 'No Applicant Yet');
        //     return redirect()->back()->with('error', 'No applicants found for this job vacancy.');
        // }

        return view('admin.job-vacancies.job-pelamar', ['applicants' => $applicants]);
    }


    public function edit($vacancies)
    {
        $result = JobVacancies::find($vacancies);
        $cities = City::all();
        return view('admin.job-vacancies.edit', ['vacancies' => $result, 'cities' => $cities]);
    }

    public function step_edit($vacancies)
    {
        // $result = JobVacanciesActivity::where('job_vacancy_id', $vacancies)->get();

        $activity_steps = ActivityStep::all();
        $result = JobVacanciesActivity::where('job_vacancy_id', $vacancies)
            ->leftJoin('activity_steps as ac', 'ac.id', '=', 'job_vacancies_activity.activity_step_id')
            ->leftJoin('job_vacancies as jv', 'jv.id', '=', 'job_vacancies_activity.job_vacancy_id')
            ->select('job_vacancies_activity.sequence', 'job_vacancies_activity.activity_step_id', 'ac.name', 'jv.job_title')
            ->get();
        // dd($result);
        return view('admin.job-vacancies.step-edit', ['vacancies' => $result, 'id' => $vacancies, 'activity_steps' => $activity_steps]);
        // return redirect()->route('vacancies.step_edit');
    }

    public function update(Request $request, $vacancies)
    {
        // dd($request->all());
        $request->validate([
            'job_title' => 'required|max:255',
            'job_description' => 'required',
            'job_requirement' => 'required',
            'job_location' => 'required|min:1|array',
            // 'job_branch' => 'required|min:1|array',
            'job_company' => 'required',
            'job_functional' => 'required',
            'job_level' => 'required',
            'job_type' => 'required',
            'job_start_date' => 'required',
            'job_end_date' => 'required',

        ]);

        $vacancy = JobVacancies::find($vacancies);
        $vacancy->job_title = $request->job_title;
        $vacancy->job_description = $request->job_description;
        $vacancy->job_requirement = $request->job_requirement;
        $vacancy->job_company = $request->job_company;
        $vacancy->job_functional = $request->job_functional;
        $vacancy->job_level = $request->job_level;
        $vacancy->job_type = $request->job_type;
        $vacancy->job_location = implode(",", $request->job_location);
        // $vacancy->job_branch = implode(",", $request->job_branch);
        $vacancy->job_start_date = $request->job_start_date;
        $vacancy->job_end_date = $request->job_end_date;


        if ($vacancy->save()) {
            return redirect()->route('vacancies.step_edit', $vacancy->id);
            // $this->step_edit($vacancy->id);
        } else {
            Alert::error('Failed', 'Job vacancy failed !');
            return redirect()->route('vacancies.index');
        }

        // return redirect()->route('vacancies.index');
    }


    public function step_update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $request->validate([
                'application_step_no' => 'required|array',
                'application_step' => 'required|array',
                // Add more validation rules for your step data
            ]);

            // Process and update the step data in your database
            $stepData = $request->only('application_step_no', 'application_step');

            $countData = JobVacanciesActivity::where('job_vacancy_id', $id)->count();

            // Start a database transaction
            DB::beginTransaction();

            if ($countData > 0) {
                // Delete existing data
                $delete = JobVacanciesActivity::where('job_vacancy_id', $id)->delete();

                if ($delete) {
                    foreach ($stepData['application_step_no'] as $key => $stepNo) {
                        JobVacanciesActivity::create([
                            'sequence' => $stepData['application_step_no'][$key],
                            'activity_step_id' => $stepData['application_step'][$key],
                            'job_vacancy_id' => $id,
                            // Add more columns if you have additional fields
                        ]);
                    }

                    // Commit the transaction
                    DB::commit();

                    Alert::success('Success', 'Data Updated!');
                    return redirect()->route('vacancies.index');
                }
            } else {
                foreach ($stepData['application_step_no'] as $key => $stepNo) {
                    JobVacanciesActivity::create([
                        'sequence' => $stepData['application_step_no'][$key],
                        'activity_step_id' => $stepData['application_step'][$key],
                        'job_vacancy_id' => $id,
                        // Add more columns if you have additional fields
                    ]);
                }

                // Commit the transaction
                DB::commit();

                Alert::success('Success', 'Data Updated!');
                return redirect()->route('vacancies.index');
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            // Rollback the transaction in case of an error
            DB::rollback();

            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($vacancies)
    {
        $vacancies = JobVacancies::where('id', $vacancies);
        $vacancies->delete();
        Alert::success('Sukses', 'Data berhasil di hapus');
        return redirect()->route('vacancies.index');
        // return redirect()->back()->with('sukses', 'data berhasil di hapus');


    }
}
