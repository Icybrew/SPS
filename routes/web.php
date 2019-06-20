<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*-------------------*/
/*   AUTHORIZATION   */
/*-------------------*/
Auth::routes();


/*-------------*/
/*   GENERAL   */
/*-------------*/
/* INDEX */
Route::get('/', 'HomeController@index')->name('home.index');

/* CONTACTS */
Route::get('/contacts', 'ContactController@index')->name('contacts.index');

/* SERVICES */
Route::get('/services', 'ServiceController@index')->name('services.index');

/* SPECIALISTS */
Route::get('/specialists', 'SpecialistController@index')->name('specialists.index');

/* Profile */
Route::resource('/profile', 'ProfileController')->middleware('auth')->except([
    'create', 'store', 'destroy'
]);
Route::get('/profile/{id}/change-password', 'ProfileController@editPassword')->middleware('auth')->name('profile.edit-password');
Route::patch('/profile/{id}/change-password', 'ProfileController@updatePassword')->middleware('auth')->name('profile.update-password');


/* Patients */
Route::get('/patients', 'PatientController@index')->middleware('doctor')->name('patients.index');
Route::get('/patients/{id}', 'PatientController@show')->middleware('doctor')->name('patients.show');

/* Medical history */
Route::resource('/patients/{id}/medical-history', 'MedicalHistoryController', [
    'as' => 'patients'
])->middleware('doctor');

/* Prescriptions */
Route::resource('/patients/{id}/prescriptions', 'PrescriptionController', [
    'as' => 'patients'
])->middleware('doctor');


/*-----------*/
/*   ADMIN   */
/*-----------*/
Route::get('/admin', 'Admin\AdminController@index')->middleware('admin')->name('admin.index');

/* ADMIN DOCTORS */
Route::resource('admin/doctors', 'Admin\DoctorController', [
    'as' => 'admin'
])->middleware('admin');

Route::get('/admin/doctors/{id}/patients', 'Admin\DoctorController@patients')->middleware('admin')->name('admin.doctors.patients');
Route::get('/admin/doctors/{id}/patients/add', 'Admin\DoctorController@addPatient')->middleware('admin')->name('admin.doctors.patients.add');
Route::post('/admin/doctors/{id}/patients', 'Admin\DoctorController@storePatient')->middleware('admin')->name('admin.doctors.patients.store');

/* ADMIN PATIENTS */
Route::resource('admin/patients', 'Admin\PatientController', [
    'as' => 'admin'
])->middleware('admin');

/* ADMIN PHARMACISTS */
Route::resource('admin/pharmacists', 'Admin\PharmacistController', [
    'as' => 'admin'
])->middleware('admin');
