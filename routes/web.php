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
Route::get('/profile/{id}/change-password', 'ProfileController@editPassword')->name('profile.edit-password')->middleware('auth');
Route::patch('/profile/{id}/change-password', 'ProfileController@updatePassword')->name('profile.update-password')->middleware('auth');

/* Medical History */
Route::resource('/medical-history', 'MedicalHistoryController')->middleware('auth');

/* Prescriptions */
Route::resource('/prescriptions', 'PrescriptionController')->middleware('auth');


/*-----------*/
/*   ADMIN   */
/*-----------*/
Route::get('/admin', 'Admin\AdminController@index')->middleware('admin')->name('admin.index');

/* ADMIN DOCTORS */
Route::resource('admin/doctors', 'Admin\DoctorController', [
    'as' => 'admin'
])->middleware('admin');

Route::get('/admin/doctors/{id}/patients', 'Admin\DoctorController@patients')->name('admin.doctors.patients');
Route::get('/admin/doctors/{id}/patients/add', 'Admin\DoctorController@addPatient')->name('admin.doctors.patients.add');
Route::post('/admin/doctors/{id}/patients', 'Admin\DoctorController@storePatient')->name('admin.doctors.patients.store');

/* ADMIN PATIENTS */
Route::resource('admin/patients', 'Admin\PatientController', [
    'as' => 'admin'
])->middleware('admin');

/* ADMIN PHARMACISTS */
Route::resource('admin/pharmacists', 'Admin\PharmacistController', [
    'as' => 'admin'
])->middleware('admin');
