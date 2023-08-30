<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;






Auth::routes();

// Home
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'WelcomeController@index')->name('welcome.index');

// Route Pendaftaran

Route::get('/form-pendaftaran', 'CandidatesController@create');

Route::post('/form-pendaftaran', 'CandidatesController@store')->name('Candidates.store');

Route::get('/form-pendaftaran-pelamar', 'PelamarsController@create');

Route::post('/form-pendaftaran-pelamar', 'PelamarsController@store')->name('pelamars.store');

// Route About



// Route::get('/candidate', 'CandidatesController')->names('candidate');

Route::group(['middleware' => 'auth'], function () {

    // admin
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    
    // //Route Pelamars
    Route::get('/pelamars', 'AdminController@index')->name('admin.index');

    Route::get('/pelamar/show/{pelamar}', 'AdminController@show')->name('admin.show');

    Route::delete('/pelamar/delete/{pelamar}', 'AdminController@destroy')->name('admin.destroy');

    Route::get('/pelamar/contact', 'AdminController@contact')->name('admin.contact');

    Route::get('/pelamar/cetak/{pelamar}/cetak', 'AdminController@cetak')->name('admin.cetak');

    
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

    Route::post('/vacancies/{vacancies}', 'JobVacanciesController@update')->name('vacancies.update');

    Route::get('/vacancies/show/{vacancies}', 'JobVacanciesController@show')->name('vacancies.show');

    Route::delete('/vacancies/delete/{vacancies}', 'JobVacanciesController@destroy')->name('vacancies.destroy');

    


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
