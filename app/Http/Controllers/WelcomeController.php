<?php

namespace App\Http\Controllers;

use App\Models\JobVacancies;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Retrieve all job vacancies
        $result = JobVacancies::all();
        return view('welcome', ['jobvacancies' => $result]);
    }
}
