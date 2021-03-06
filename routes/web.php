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

Route::group (['middleware' => 'auth'], function () {
	Route::resource('task', 'TaskController');
	Route::resource('company', 'CompanyController');
	Route::resource('project', 'ProjectController');
	Route::get('company/{id}/invite', 'InviteController@inviteForm')->name('company_invite');
	Route::put('company/{id}/sendinvite', 'InviteController@sendInvite')->name('send_invite');
    Route::get('/company/view/invite/{token}', 'InviteController@viewInvite')->name('view_invite');
    Route::get('/company/invite/{response}/{token}', 'InviteController@inviteResponse')->name('invite_respond');
    Route::get('/company/setdefault/{id}', 'CompanyController@setDefaultCompany')->name('set_default_company');
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/calendar', 'TaskController@viewCalendar')->name('calendar');
});

Route::group (['middleware' => ['auth', 'can:admin']], function () {
    Route::resource('user', 'Admin\UserController')->except([
        'create', 'store', 'show', 'destroy'
    ]);
});


/*
   auth routes
*/
Auth::routes();
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('google_login');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout');

