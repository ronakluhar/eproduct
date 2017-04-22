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
//Front
Route::get('/', ['as' => 'home', 'uses' => 'Front\IndexController@index']);
Route::get('/home', ['as' => 'home', 'uses' => 'Front\IndexController@index']);
Route::get('/login', ['as' => 'login', 'uses' => 'Front\LoginController@login']);
Route::get('/signup', ['as' => 'signup', 'uses' => 'Front\SignupController@signup']);
Route::post('/doSignup', ['as' => 'doSignup', 'uses' => 'Front\SignupController@doSignup']);
Route::post('/login', ['as' => 'login', 'uses' => 'Front\LoginController@doLogin']);
Route::get('/logout', 'Front\LoginController@logout');

Route::get('profile', ['as' => 'profile', 'uses' => 'Front\UserController@index']);
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Front\DashboardController@index']);
Route::get('/forgot-password', ['as' => 'forgot-password', 'uses' => 'Front\PasswordController@forgotPassword']);
Route::post('/forgot-password', ['as' => 'forgot-password', 'uses' => 'Front\PasswordController@sendPassword']);
Route::get('reset-password', 'Front\PasswordController@resetPassword');
Route::post('reset-password', 'Front\PasswordController@setNewPassword');
Route::get('verify-user', 'Front\VerifyUserManagementController@index');
Route::post('profile_setting', 'Front\UserController@saveProfileSetting');
Route::post('change_password', 'Front\PasswordController@changePassword');

//Admin
Route::get('/admin', ['as' => 'admin', 'uses' => 'Admin\IndexController@login']);
Route::get('/admin/login', ['as' => 'admin', 'uses' => 'Admin\IndexController@login']);
Route::post('/admin/login', ['as' => 'admin', 'uses' => 'Admin\IndexController@doLogin']);
Route::get('/admin/logout', 'Admin\IndexController@logout');
Route::get('/admin/signup', ['as' => 'signup', 'uses' => 'Admin\IndexController@signup']);

Route::get('/admin/forgot-password', ['as' => 'forgot-password', 'uses' => 'Admin\IndexController@forgotPassword']);
Route::post('/admin/forgot-password', 'Admin\IndexController@sendPassword');
Route::get('/admin/reset-password/{token}', 'Admin\IndexController@resetPassword');
Route::post('/admin/reset-password/', 'Admin\IndexController@setNewPassword');

Route::get('/admin/dashboard', ['as' => 'dashboard', 'uses' => 'Admin\DashboardController@index']);

//Admin User Profile
Route::get('/admin/user-profile', ['as' => 'user-profile', 'uses' => 'Admin\UsersController@profile']);
Route::post('/admin/user-profile', 'Admin\UsersController@saveProfile');
Route::post('/admin/change-password', 'Admin\UsersController@changePassword');

Route::get('/admin/create-user', ['as' => 'create-user', 'uses' => 'Admin\UsersController@createUser']);
Route::get('/admin/list-user', ['as' => 'list-user', 'uses' => 'Admin\UsersController@index']);
Route::get('admin/deleteuser/{id}', 'Admin\UsersController@delete');
Route::post('admin/saveuser', 'Admin\UsersController@save');
Route::get('admin/edituser/{id}', 'Admin\UsersController@edit');
Route::get('admin/user-messages/{id}', 'Admin\UsersController@getUserMessages');
Route::post('admin/save-message', 'Admin\UsersController@saveNewMessage');

//Admin Email Template
Route::get('/admin/create-email-template', ['as' => 'create-email-template', 'uses' => 'Admin\EmailTemplateController@createEmailTemplate']);
Route::get('/admin/list-email-template', ['as' => 'list-email-template', 'uses' => 'Admin\EmailTemplateController@index']);
Route::get('admin/delete-email-template/{id}', 'Admin\EmailTemplateController@delete');
Route::post('admin/save-email-template', 'Admin\EmailTemplateController@save');
Route::get('admin/edit-email-template/{id}', 'Admin\EmailTemplateController@edit');


//Admin CMS Template Management
Route::get('admin/list-cms-template', 'Admin\CMSManagementController@index');
Route::get('admin/create-cms-template', 'Admin\CMSManagementController@createCMSTemplate');
Route::post('admin/create-cms-template', 'Admin\CMSManagementController@doCreateCMSTemplate');
Route::get('admin/edit-cms-template/{id}', 'Admin\CMSManagementController@editCMSTemplate');
Route::get('admin/delete-cms-template/{id}', 'Admin\CMSManagementController@deleteCMSTemplate');

// Admin School management
Route::get('admin/list-school', 'Admin\SchoolController@index');
Route::get('admin/importSchoolQuickFact', 'Admin\SchoolController@importCSV');
Route::post('admin/saveSchoolQuickFact', 'Admin\SchoolController@saveSchoolQuickFact');

Route::get('admin/importSchoolFaculty', 'Admin\SchoolDetailController@importSchoolFaculty');
Route::post('admin/saveSchoolFaculty', 'Admin\SchoolDetailController@saveSchoolFaculty');

Route::get('admin/importSchoolLibrary', 'Admin\SchoolDetailController@importSchoolLibrary');
Route::post('admin/saveSchoolLibrary', 'Admin\SchoolDetailController@saveSchoolLibrary');

Route::get('admin/import-school-apply-accepted', 'Admin\SchoolController@import_apply_accepted_CSV');
Route::post('admin/save-school-apply-accepted', 'Admin\SchoolController@save_school_apply_accepted');
Route::get('admin/import-school-award-level', 'Admin\SchoolController@import_award_level_CSV');
Route::post('admin/save-school-award-level', 'Admin\SchoolController@save_school_award_level');
Route::get('admin/import-school-graduation-rate-time', 'Admin\SchoolController@import_graduation_rate_time_CSV');
Route::post('admin/save-school-graduation-rate-time', 'Admin\SchoolController@save_school_graduation_rate_time');
Route::get('admin/import-school-ROTC', 'Admin\SchoolController@import_ROTC_CSV');
Route::post('admin/save-school-ROTC', 'Admin\SchoolController@save_school_ROTC');

Route::get('admin/importSchoolCompletion', 'Admin\SchoolDetailController@importSchoolCompletion');
Route::post('admin/saveSchoolCompletion', 'Admin\SchoolDetailController@saveSchoolCompletion');

Route::get('admin/import-school-students-to-faculty', 'Admin\SchoolController@import_students_to_faculty_CSV');
Route::post('admin/save-school-students-to-faculty', 'Admin\SchoolController@save_school_students_to_faculty');
Route::get('admin/import-school-study-abroad', 'Admin\SchoolController@import_study_abroad_CSV');
Route::post('admin/save-school-study-abroad', 'Admin\SchoolController@save_school_study_abroad');
Route::get('admin/import-school-teacher-certification', 'Admin\SchoolController@import_teacher_certification_CSV');
Route::post('admin/save-school-teacher-certification', 'Admin\SchoolController@save_school_teacher_certification');
