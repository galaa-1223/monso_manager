<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ManagerAuthController;

use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\TeachersController;
use App\Http\Controllers\Manager\StudentsController;
use App\Http\Controllers\Manager\AngiController;
use App\Http\Controllers\Manager\HicheelController;
use App\Http\Controllers\Manager\HuvaariController;
use App\Http\Controllers\Manager\MergejilController;
use App\Http\Controllers\Manager\MergejilBagshController;
use App\Http\Controllers\Manager\TenhimController;
use App\Http\Controllers\Manager\ShalgaltController;
use App\Http\Controllers\Manager\EventController;
use App\Http\Controllers\Manager\SettingsController;
use App\Http\Controllers\Manager\NewsController;
use App\Http\Controllers\Manager\UploadsController;

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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/****************************************************************************/
/*********************************  MANAGER  ********************************/
/****************************************************************************/

// Manager Login
Route::get('manager', [ManagerAuthController::class, 'managerGet'])->name('managerLogin');
Route::get('manager/login', [ManagerAuthController::class, 'managerGetLogin'])->name('managerLogin');
Route::post('manager/login', [ManagerAuthController::class, 'managerLogin'])->name('managerLoginPost');
Route::get('manager/logout', [ManagerAuthController::class, 'managerLogout'])->name('logout');

Route::group(['prefix' => 'manager','middleware' => 'managerauth'], function () {
	// Manager Dashboard
	Route::get('dashboard',[ManagerController::class, 'dashboard'])->name('manager-dashboard');	
	
	// Teacher
	Route::get('teachers',[TeachersController::class, 'index'])->name('manager-teachers');
	Route::get('teachers/add',[TeachersController::class, 'add'])->name('manager-teachers-add');
	Route::get('teachers/edit/{id}',[TeachersController::class, 'edit'])->name('teachers-edit');
	Route::get('teachers/fond',[TeachersController::class, 'fond'])->name('manager-teachers-fond');
	Route::get('teachers/fond_list/{id}',[TeachersController::class, 'fond_list'])->name('manager-teachers-fond-list');

	Route::post('teachers/add',[TeachersController::class, 'store'])->name('manager-teachers-save');
	Route::post('teachers/edit/{id}',[TeachersController::class, 'update'])->name('manager-teachers-edit');
	Route::post('teachers/delete/',[TeachersController::class, 'delete'])->name('manager-teachers-delete-ajax');
	Route::post('teachers/fond_add',[TeachersController::class, 'fond_store'])->name('manager-teachers-fond-save');
	Route::post('teachers/fond_delete/',[TeachersController::class, 'fond_delete'])->name('manager-teachers-fond-delete-ajax');

	Route::delete('teachers/delete/{id}',[TeachersController::class, 'destroy'])->name('manager-teachers-delete');

	// Angi
	Route::get('angi',[AngiController::class, 'index'])->name('manager-angi');
	Route::get('angi/add',[AngiController::class, 'add'])->name('manager-angi-add');
	Route::get('angi/edit/{id}',[AngiController::class, 'edit'])->name('angi-edit');

	Route::post('angi/add',[AngiController::class, 'store'])->name('manager-angi-save');
	Route::post('angi/edit/{id}',[AngiController::class, 'update'])->name('manager-angi-edit');
	Route::post('angi/delete/',[AngiController::class, 'delete'])->name('manager-angi-delete-ajax');

	Route::delete('angi/delete/{id}',[AngiController::class, 'destroy'])->name('manager-angi-delete');

	// Mergejil
	Route::get('mergejil',[MergejilController::class, 'index'])->name('manager-mergejil');
	Route::get('mergejil/add',[MergejilController::class, 'add'])->name('manager-mergejil-add');
	Route::get('mergejil/edit/{id}',[MergejilController::class, 'edit'])->name('mergejil-edit');

	Route::post('mergejil/add',[MergejilController::class, 'store'])->name('manager-mergejil-save');
	Route::post('mergejil/edit/{id}',[MergejilController::class, 'update'])->name('manager-mergejil-edit');
	Route::post('mergejil/delete/',[MergejilController::class, 'delete'])->name('manager-mergejil-delete-ajax');

	Route::delete('mergejil/delete/{id}',[MergejilController::class, 'destroy'])->name('manager-mergejil-delete');

	// Mergejil Bagsh
	Route::get('mergejil_bagsh',[MergejilBagshController::class, 'index'])->name('manager-mergejil_bagsh');
	Route::get('mergejil_bagsh/add',[MergejilBagshController::class, 'add'])->name('manager-mergejil_bagsh-add');
	Route::get('mergejil_bagsh/edit/{id}',[MergejilBagshController::class, 'edit'])->name('mergejil_bagsh-edit');

	Route::post('mergejil_bagsh/add',[MergejilBagshController::class, 'store'])->name('manager-mergejil_bagsh-save');
	Route::post('mergejil_bagsh/edit/{id}',[MergejilBagshController::class, 'update'])->name('manager-mergejil_bagsh-edit');
	Route::post('mergejil_bagsh/delete/',[MergejilBagshController::class, 'delete'])->name('manager-mergejil_bagsh-delete-ajax');

	Route::delete('mergejil_bagsh/delete/{id}',[MergejilBagshController::class, 'destroy'])->name('manager-mergejil_bagsh-delete');

	// Tenhim
	Route::get('tenhim',[TenhimController::class, 'index'])->name('manager-tenhim');
	Route::get('tenhim/add',[TenhimController::class, 'add'])->name('manager-tenhim-add');
	Route::get('tenhim/edit/{id}',[TenhimController::class, 'edit'])->name('tenhim-edit');

	Route::post('tenhim/add',[TenhimController::class, 'store'])->name('manager-tenhim-save');
	Route::post('tenhim/edit/{id}',[TenhimController::class, 'update'])->name('manager-tenhim-edit');
	Route::post('tenhim/delete/',[TenhimController::class, 'delete'])->name('manager-tenhim-delete-ajax');

	Route::delete('tenhim/delete/{id}',[TenhimController::class, 'destroy'])->name('manager-tenhim-delete');

	// Hicheel
	Route::get('hicheel',[HicheelController::class, 'index'])->name('manager-hicheel');
	Route::get('hicheel/edit/{id}',[HicheelController::class, 'edit'])->name('hicheel-edit');

	Route::post('hicheel/add',[HicheelController::class, 'store'])->name('manager-hicheel-save');
	Route::post('hicheel/edit/{id}',[HicheelController::class, 'update'])->name('manager-hicheel-edit');
	Route::post('hicheel/delete/',[HicheelController::class, 'delete'])->name('manager-hicheel-delete-ajax');

	Route::delete('hicheel/delete/{id}',[HicheelController::class, 'destroy'])->name('manager-hicheel-delete');

	// Huvaari
	Route::get('huvaari',[HuvaariController::class, 'index'])->name('manager-huvaari');
	Route::get('huvaari/angi',[HuvaariController::class, 'angi'])->name('manager-huvaari-angi');
	Route::get('huvaari/shalgalt',[HuvaariController::class, 'shalgalt'])->name('manager-huvaari-shalgalt');
	Route::get('huvaari/bagsh/{bagshId}',[HuvaariController::class, 'bagsh'])->name('manager-huvaari-bagsh');

	Route::post('huvaari/add',[HuvaariController::class, 'store'])->name('manager-huvaari-save');

	// Students
	Route::get('students',[StudentsController::class, 'index'])->name('manager-students');
	Route::get('students/add',[StudentsController::class, 'add'])->name('manager-students-add');
	Route::get('students/edit/{id}',[StudentsController::class, 'edit'])->name('students-edit');

	Route::post('students/add',[StudentsController::class, 'store'])->name('manager-students-save');
	Route::post('students/edit/{id}',[StudentsController::class, 'update'])->name('manager-students-edit');
	Route::post('students/delete/',[StudentsController::class, 'delete'])->name('manager-students-delete-ajax');

	// Shalgalt
	Route::get('shalgalt',[ShalgaltController::class, 'index'])->name('manager-shalgalt');
	Route::get('shalgalt/add',[ShalgaltController::class, 'add'])->name('manager-shalgalt-add');
	Route::get('shalgalt/asuult/{id}',[ShalgaltController::class, 'asuult'])->name('manager-shalgalt-asuult');
	Route::get('shalgalt/asuult/{id}/add',[ShalgaltController::class, 'asuult_add'])->name('manager-shalgalt-asuult-add');

	Route::post('shalgalt/shalgalt/delete/',[ShalgaltController::class, 'shalgalt_delete'])->name('manager-shalgalt-delete-ajax');
	Route::post('shalgalt/add',[ShalgaltController::class, 'store'])->name('manager-shalgalt-save');
	Route::post('shalgalt/asuult/{id}/add',[ShalgaltController::class, 'asuult_store'])->name('manager-shalgalt-asuult-save');
	Route::post('shalgalt/asuult/delete/',[ShalgaltController::class, 'asuult_delete'])->name('manager-shalgalt-asuult-delete-ajax');

	// News
	Route::get('news',[NewsController::class, 'index'])->name('manager-news');
	Route::get('news/add',[NewsController::class, 'add'])->name('manager-news-add');
	Route::get('news/edit/{id}',[NewsController::class, 'edit'])->name('news-edit');

	Route::post('news/add',[NewsController::class, 'store'])->name('manager-news-save');
	Route::post('news/edit/{id}',[NewsController::class, 'update'])->name('manager-news-edit');
	Route::post('news/delete/',[NewsController::class, 'delete'])->name('manager-news-delete-ajax');

	Route::delete('news/delete/{id}',[NewsController::class, 'destroy'])->name('manager-news-delete');

	// Event
	Route::get('events',[EventController::class, 'index'])->name('manager-events');

	// Settings
	Route::get('settings',[SettingsController::class, 'index'])->name('manager-settings');
	Route::get('settings/password',[SettingsController::class, 'password'])->name('manager-settings-password');
	Route::get('settings/huvaari',[SettingsController::class, 'huvaari'])->name('manager-settings-huvaari');

	Route::post('settings/changePassword',[SettingsController::class, 'changePassword'])->name('manager-settings-changepassword');
	Route::post('settings/changePicture/{id}',[SettingsController::class, 'changePicture'])->name('manager-settings-changepicture');

	// Ajax
	Route::get('shalgalt/ajax_hariult',[ShalgaltController::class, 'ajax_hariult'])->name('manager-shalgalt-ajax_hariult');
	Route::get('shalgalt/ajax_hariult_add',[ShalgaltController::class, 'ajax_hariult_add'])->name('manager-shalgalt-ajax_hariult_add');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
