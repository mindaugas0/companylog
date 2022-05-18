<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

//company route

Route::prefix('companies')->group(function () {
    Route::get('', 'App\Http\Controllers\CompanyController@index')->name('company.index');
    Route::get('create', 'App\Http\Controllers\CompanyController@create')->name('company.create');
    Route::post('store', 'App\Http\Controllers\CompanyController@store')->name('company.store');
    Route::get('edit/{company}', 'App\Http\Controllers\CompanyController@edit')->name('company.edit');
    Route::post('update/{company}', 'App\Http\Controllers\CompanyController@update')->name('company.update');
    Route::post('destroy/{company}', 'App\Http\Controllers\CompanyController@destroy')->name('company.destroy');
    Route::get('show/{company}', 'App\Http\Controllers\CompanyController@show')->name('company.show');
    Route::get('search', 'App\Http\Controllers\CompanyController@companySearch')->name('company.search');
});

//employee route

Route::prefix('employees')->group(function () {
    Route::get('', 'App\Http\Controllers\EmployeeController@index')->name('employee.index');
    Route::get('create', 'App\Http\Controllers\EmployeeController@create')->name('employee.create');
    Route::post('store', 'App\Http\Controllers\EmployeeController@store')->name('employee.store');
    Route::get('edit/{employee}', 'App\Http\Controllers\EmployeeController@edit')->name('employee.edit');
    Route::post('update/{employee}', 'App\Http\Controllers\EmployeeController@update')->name('employee.update');
    Route::post('destroy/{employee}', 'App\Http\Controllers\EmployeeController@destroy')->name('employee.destroy');
    Route::get('show/{employee}', 'App\Http\Controllers\EmployeeController@show')->name('employee.show');
    Route::get('search', 'App\Http\Controllers\EmployeeController@employeeSearch')->name('employee.search');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
