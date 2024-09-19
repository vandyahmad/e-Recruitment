<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;






// Auth::routes();
Auth::routes(['register' => false]);
Route::get('/auth/register', 'RegisterController@index')->name('register.index');
Route::post('/auth/register/store', 'RegisterController@store')->name('register.store');

// Home
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'WelcomeController@index')->name('welcome.index');
Route::get('/job-filter', 'WelcomeController@index_filter')->name('filter.index');
Route::get('/filter/jobvacancies', 'WelcomeController@filter')->name('welcome.filter');


// Route Data Pelamar
Route::get('/form-data-pelamar', 'UsersDataController@create')->name('UsersData.create');

Route::post('/form-data-pelamar', 'UsersDataController@store')->name('UsersData.store');

Route::put('/update-data-pelamar/{id}', 'UsersDataController@update')->name('UsersData.update');

Route::get('/form-interview', 'UsersDataController@createFormInterview')->name('UsersData.create-form-interview');

Route::post('/form-interview/{id}', 'UsersDataController@updateIdentity')->name('UserIdentity.update');

Route::post('/form-interview/{id}/family', 'UsersDataController@updateFamily')->name('UserFamily.update');

Route::post('/form-interview/{id}/family/delete', 'UsersDataController@deleteFamily')->name('UserFamily.delete');

Route::post('/form-interview/{id}/employment-history', 'UsersDataController@updateEmploymentHistory')->name('UserEmploymentHistory.update');

Route::post('/form-interview/{id}/employment-history/delete', 'UsersDataController@deleteEmploymentHistory')->name('UserEmploymentHistory.delete');

Route::post('/form-interview/{id}/education', 'UsersDataController@updateEducation')->name('UserEducation.update');

Route::post('/form-interview/{id}/answer', 'UsersDataController@updateAnswer')->name('UserAnswer.update');


// Route Data Employee
// Route::post('/form-data-pelamar', 'UsersDataController@store')->name('UsersData.store');

Route::put('/update-data-employee/{id}', 'EmployeeController@update')->name('Employee.update');

Route::put('/update-employee-family/{employeeId}', 'EmployeeController@updateFamily')->name('EmployeeFamily.update');

Route::put('/update-employee-document/{employeeId}', 'EmployeeController@updateDocument')->name('EmployeeDocument.update');


// Route Submit Lamaran

Route::get('/form-pendaftaran', 'CandidatesController@create');

Route::post('/form-pendaftaran', 'CandidatesController@store')->name('Candidates.store');

Route::get('/form-pendaftaran-pelamar', 'PelamarsController@create');

Route::post('/', 'PelamarsController@store')->name('pelamars.store');





// Route About



// Route::get('/candidate', 'CandidatesController')->names('candidate');

Route::group(['middleware' => 'auth'], function () {
    Route::middleware(['role_user'])->group(function () {
        Route::get('/apply', 'WelcomeController@apply')->name('welcome.apply');
        Route::get('/profile-pelamar', 'PelamarsController@index')->name('pelamar.index');
        Route::get('/detail-profile', 'PelamarsController@detailLoginUser')->name('pelamar.detail-login-user');
        Route::get('/detail-profile-data', 'PelamarsController@detailProfileData')->name('pelamar.detail-profile-data');
        Route::get('/job-applied', 'PelamarsController@jobApplied')->name('pelamar.job-applied');
        // Route::get('/form-interview', 'PelamarsController@CreateFormInterview')->name('pelamar.create-form-interview');
        // Route::post('/form-interview', 'PelamarsController@storeFormInterview')->name('pelamar.store-form-interview');
        Route::get('/job-applied-show/{id}', 'PelamarsController@jobAppliedStatus')->name('job-applied.status');
        // Route::get('/job-applied-activity', 'PelamarsController@jobAppliedActivity')->name('pelamar.job-applied-activity');



    });
    Route::middleware(['role_admin'])->group(function () {

        Route::group(['prefix' => 'admin'], function () {

            // admin
            Route::get('/home', function () {
                return view('admin.home');
            })->name('admin.home');


            // //Route Pelamars
            Route::get('/pelamars', 'AdminController@index_pelamar')->name('admin.index_pelamar');

            Route::get('/pelamar/show/{pelamar}', 'AdminController@show_pelamar')->name('admin.show_pelamar');

            Route::delete('/pelamar/delete/{pelamar}', 'AdminController@destroy_pelamar')->name('admin.destroy_pelamar');

            Route::get('/pelamar/contact', 'AdminController@contact_pelamar')->name('admin.contact_pelamar');

            Route::get('/pelamar/cetak/{pelamar}', 'AdminController@cetak_pelamar')->name('admin.cetak_pelamar');
           
            Route::get('/form-interview/{pelamar}', 'AdminController@exportFormInterview')->name('admin.cetak_form_interview');

            Route::post('/process/pelamar', 'AdminController@process')->name('admin.process_pelamar');

            Route::get('/pelamar/activity/{activity}', 'AdminController@activity')->name('admin.activity_pelamar');

            // Route::get('/process/pelamar', 'AdminController@activity_step')->name('admin.activity_step');

            // Route::get('/admin/activity_step', 'AdminController@activity_step')->name('admin.activity_step');






            //Route Candidates
            Route::get('/candidates', 'AdminController@index_candidate')->name('admin.index_candidate');

            Route::get('/candidate/show/{candidate}', 'AdminController@show_candidate')->name('admin.show_candidate');

            Route::delete('/candidate/delete/{candidate}', 'AdminController@destroy_candidate')->name('admin.destroy_candidate');

            Route::get('/candidate/delete/contact', 'AdminController@contact_candidate')->name('admin.contact_candidate');

            Route::get('/candidate/cetak/{candidate}/cetak', 'AdminController@cetak_candidate')->name('admin.cetak_candidate');


            //Route Employee

            Route::get('/employee', 'AdminController@employee')->name('admin.employee');


            //Route Vacancies

            Route::get('/vacancies', 'JobVacanciesController@index')->name('vacancies.index');

            Route::get('/vacancies/create', 'JobVacanciesController@create')->name('vacancies.create');

            Route::post('/vacancies/store', 'JobVacanciesController@store')->name('vacancies.store');

            Route::get('/vacancies/{vacancies}/edit', 'JobVacanciesController@edit')->name('vacancies.edit');

            Route::get('/vacancies/{vacancies}/edit/step', 'JobVacanciesController@step_edit')->name('vacancies.step_edit');

            Route::get('/vacancies/step/{id}', 'JobVacanciesController@step')->name('vacancies.step');

            Route::post('/vacancies/step/store', 'JobVacanciesController@step_store')->name('vacancies.step_store');

            Route::post('/vacancies/{vacancies}', 'JobVacanciesController@update')->name('vacancies.update');

            Route::put('/vacancies/step/{id}', 'JobVacanciesController@step_update')->name('vacancies.step_update');

            Route::get('/vacancies/show/{vacancies}', 'JobVacanciesController@show')->name('vacancies.show');

            Route::get('/vacancies/{vacancies}/pelamar', 'JobVacanciesController@pelamar')->name('vacancies.pelamar');

            Route::delete('/vacancies/delete/{vacancies}', 'JobVacanciesController@destroy')->name('vacancies.destroy');
        });
    });

    // Route::group(['prefix' => 'user'], function () {
    // Route::get('/', 'WelcomeController@index')->name('user.home');
    // Route::get('/home', function () 
    //     return view('welcome');
    // })->name('user.home');
    // });
});
