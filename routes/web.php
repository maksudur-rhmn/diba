<?php

use App\Http\Controllers\FooterController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

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

// FrontendController
Route::get('/', 'FrontendController@index')->name('front.index');
Route::get('/about', 'FrontendController@about')->name('front.about');
Route::get('/docs', 'FrontendController@docs')->name('front.docs');
Route::get('/hos', 'FrontendController@hos')->name('front.hos');
Route::get('/phar', 'FrontendController@phar')->name('front.phar');
Route::get('/ambu', 'FrontendController@ambu')->name('front.ambu');
Route::post('/create/admin', 'FrontendController@createAdmin')->name('create.admin');
Route::get('/blog/grid', 'FrontendController@blogGrid')->name('front.blogs');
Route::get('/blog/{slug}', 'FrontendController@blogDetails')->name('front.blogDetails');
Route::get('/search/all', 'FrontendController@searchAll')->name('search.all');
// FrontendController ENDS

// AppointmentController
Route::resource('appointment', 'AppointmentController');
// AppointmentController ENDS

// CustomerDashboardController
Route::get('/customer/dashboard', 'CustomerDashboardController@index');
// CustomerDashboardController ENDS


Auth::routes();

// HomeController
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all/appointments', 'Homecontroller@appointment')->name('all.appointment');
Route::get('/reconfirm/{app_id}/appointment', 'HomeController@reconfirm')->name('reconfirm.appointment');
Route::get('/cancel/{app_id}/appointment', 'HomeController@cancel')->name('cancel.appointment');
Route::get('/create/{user_id}/admin', 'HomeController@createAdmin')->name('create.admin');
// HomeController ENDS 

// UserController 
Route::resource('users', 'UserController');
Route::get('/users/{user_id}/delete', 'UserController@delete')->name('users.delete');
// UserController ENDS

// ProfileController 
Route::get('/change/{user_id}/password', 'ProfileController@changePassword')->name('change.password');
Route::post('/password/updated', 'ProfileController@passwordUpdated')->name('password.updated');
// ProfileController ENDS 


// RoleController
Route::get('roles', 'RoleController@index')->name('roles.index');
Route::get('create/permissions', 'RoleController@createPermissions');
Route::post('roles/store', 'RoleController@store')->name('roles.store');
Route::post('roles/assign', 'RoleController@roleAssign')->name('roles.assign');
Route::get('/roles/{user_id}/revoke', 'RoleController@roleRevoke')->name('roles.revoke');
// RoleController ENDS 

// TaskController
Route::resource('tasks', 'TaskController');
Route::post('tasks/submission/role', 'TaskController@completedFromRoles')->name('tasks.completedFromRoles');
Route::post('tasks/submission/user', 'TaskController@completedFromUsers')->name('tasks.completedFromUsrers');
Route::get('tasks/all/list', 'TaskController@all')->name('tasks.all');
Route::get('/tasks/{task_id}/start', 'TaskController@taskStart')->name('tasks.started');
Route::get('/tasks/{task_id}/seen', 'TaskController@seen')->name('tasks.seen');
Route::get('/tasks/{task_id}/admin/seen', 'TaskController@seenfromadmin')->name('tasks.seenfromadmin');
// TaskController ENDS

// MyTaskController
Route::get('/tasks/my/unique/tasks', 'MyTaskController@index')->name('my.tasks');
// MyTaskController ENDS

// WebsiteSettingController 
Route::resource('settings', 'WebsiteSettingController');
// WebsiteSettingController ENDS

// CategoryController
Route::resource('categories', 'CategoryController');
// CategoryController ENDS

// DoctorController
Route::resource('doctors', 'DoctorController');
Route::get('/all/doctors', 'DoctorController@all')->name('doctors.all');
Route::get('/feature/{doc_id}/doc', 'DoctorController@feature')->name('doctors.feature');
Route::get('/revoke/{doc_id}/doc', 'DoctorController@revoke')->name('doctors.revoke');
Route::get('/doc/{doc_id}/office', 'DoctorController@out')->name('doctors.outOfOffice');
Route::get('/doc/{doc_id}/inoffice', 'DoctorController@in')->name('doctors.inOffice');
// DoctorController ENDS

// HospitalController
Route::resource('hospitals', 'HospitalController');
Route::get('/all/hospitals', 'HospitalController@all')->name('hospitals.all');
Route::get('/feature/{hos_id}/hos', 'HospitalController@feature')->name('hospitals.feature');
Route::get('/revoke/{hos_id}/hos', 'HospitalController@revoke')->name('hospitals.revoke');
// HospitalController ENDS

// PharmacyController
Route::resource('pharmacies', 'PharmacyController');
Route::get('/all/pharmacies', 'PharmacyController@all')->name('pharmacies.all');
Route::get('/feature/{phar_id}/phar', 'PharmacyController@feature')->name('pharmacies.feature');
Route::get('/revoke/{phar_id}/phar', 'PharmacyController@revoke')->name('pharmacies.revoke');
// PharmacyController ENDS

// AmbulanceController
Route::resource('ambulance', 'AmbulanceController');
Route::get('/all/ambulance', 'AmbulanceController@all')->name('ambulance.all');
Route::get('/feature/{ambu_id}/ambu', 'AmbulanceController@feature')->name('ambulance.feature');
Route::get('/revoke/{ambu_id}/ambu', 'AmbulanceController@revoke')->name('ambulance.revoke');
// AmbulanceController ENDS

// AdController
Route::resource('ads', 'AdController');
// AdController ENDS

// SponsorController
Route::resource('sponsors', 'SponsorController');
// SponsorController ENDS

// BlogCategoryController
Route::resource('blog-categories', 'BlogCategoryController');
// BlogCategoryController ENDS

// BlogController 
Route::resource('blogs', 'BlogController');
Route::get('/all/blogs', 'BlogController@all')->name('blogs.all');
// BlogController ENDS

// SubscriberController
Route::get('subscribers', 'SubscriberController@index')->name('subscribers.index');
Route::post('subscribers/store', 'SubscriberController@store')->name('subscribers.store');
// SubscriberController ENDS

// FooterController
Route::resource('footer', 'FooterController');
// FooterController ENDS

