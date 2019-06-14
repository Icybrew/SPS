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

/*-----------*/
/*   ADMIN   */
/*-----------*/
Route::get('/admin', 'Admin\AdminController@index')->middleware('admin')->name('admin.index');

/* ADMIN DOCTORS */
Route::resource('admin/doctors', 'Admin\DoctorController', [
    'as' => 'admin'
])->middleware('admin');

/* ADMIN PATIENTS */
Route::resource('admin/patients', 'Admin\PatientController', [
    'as' => 'admin'
])->middleware('admin');