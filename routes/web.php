<?php

use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('admin')->group(function(){

	Route::get('/doctor/trash', 'DoctorController@trash')->name('doctor.trash');
	Route::post('doctor/trash-back', 'DoctorController@backToList')->name('doctor.trash-back');
	Route::resource('doctor', 'DoctorController');


	Route::get('/hospital/trash', 'HospitalController@trash')->name('hospital.trash');
	Route::post('hospital/trash-back', 'HospitalController@backToList')->name('hospital.trash-back');
	Route::resource('hospital', 'HospitalController');


	Route::get('/treatment/trash', 'TreatmentController@trash')->name('treatment.trash');
	Route::post('treatment/trash-back', 'TreatmentController@backToList')->name('treatment.trash-back');
	Route::resource('treatment', 'TreatmentController');


	Route::resource('testimonial', 'TestimonialController');
});
