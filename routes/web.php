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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'UsersController@dashboard')->name('users.dashboard');
Route::get('/editprofile/{id}', 'UsersController@editProfile')->name('users.editprofile');
Route::post('/changepassword/{id}', 'UsersController@changePassword')->name('users.changepassword');
Route::post('/changeskin/{id}', 'UsersController@changeSkin')->name('users.changeskin');


Route::resource('companies','CompaniesController');//->middleware('userVerification');

//invoice
Route::get('/no_form_inv', 'InvoicesController@form_without')->name('invoices.no_form_inv');
Route::post('invoices', 'InvoicesController@index')->name('invoices.index');
Route::get('invoices/no_form_inv', 'InvoicesController@form_without')->name('invoices.form_without');
Route::get('invoices/no_form_inv/{id}', 'InvoicesController@show_without_form')->name('invoices.show_without_form');
Route::post('invoices/no_form_inv/', 'InvoicesController@form_without_select')->name('invoices.form_without_select');
Route::get('invoices/assign_form/{id}', 'InvoicesController@assign_form')->name('invoices.assign_form');
Route::post('invoices/assign_update/{id}', 'InvoicesController@update_assign')->name('invoices.update_assign');
Route::get('invoices/ajax/{id}', 'InvoicesController@ajax')->name('invoices.ajax');
Route::get('invoices/company_ajax/{id}', 'InvoicesController@company_ajax')->name('invoices.company_ajax');
Route::post('/invoices/dropdown', 'InvoicesController@dropdown');
Route::resource('invoices','InvoicesController');
Route::resource('users','UsersController');

//invoiceinput or drag and drop
// Route::resource('invoices/createdraganddrop','InvoiceinputsController');
Route::get('dragdrop/index', 'InvoiceinputsController@index')->name('dragdrop.index');
Route::get('dragdrop/invoiceslist', 'InvoiceinputsController@create')->name('dragdrop.invoiceslist');
Route::post('dragdrop/createdraganddrop','InvoiceinputsController@store')->name('invoices.store_inputs');
Route::get('dragdrop/createdraganddrop/{id}','InvoiceinputsController@createdrag')->name('dragdrop.createdrag');
Route::post('dragdrop/list-dropdown/','InvoiceinputsController@list_createform')->name('dragdrop.list_createform');
Route::delete('dragdrop/delete/{id}', 'InvoiceinputsController@destroy')->name('dragdrop.delete');

//parse
Route::get('parse/list','FormdatasController@list')->name('parse.list');
Route::get('parse/show_data/{id}','FormdatasController@show_data')->name('parse.show_data');
Route::get('parse/parse/{id}','FormdatasController@show')->name('parse.show');
Route::get('parse/ajax_dropdown/{id}','FormdatasController@select_ajax')->name('parse.select_ajax');
Route::post('parse/parse/', 'FormdatasController@store')->name('parse.store');
Route::post('parse/search', 'FormdatasController@search_form')->name('parse.search_form');
Route::resource('about','AboutController');
Auth::routes();