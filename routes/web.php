<?php

use App\Http\Controllers\API\EmployeeDataController;
use App\Http\Controllers\API\EmployerController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\StateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Backend\UserController;
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
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::post('country-states', [CountryController::class, 'getStates'])->name('get-states');
    Route::resource('cities', CityController::class);
    Route::resource('departments', DepartmentController::class);

    Route::group(['middleware' => ['role:super_admin|admin']], function () {
        Route::resource('activities', ActivityController::class);
    });

    // API Routes
    Route::group(['prefix'=>'api/'], function () {
        Route::get('employees/countries', [EmployeeDataController::class, 'countries']);
        Route::get('employees/{country}/states', [EmployeeDataController::class, 'states']);
        Route::get('employees/{state}/cities', [EmployeeDataController::class, 'cities']);
        Route::get('employees/departments', [EmployeeDataController::class, 'departments']);

        // Route::get('employees', [EmployerController::class, 'index']);
        // Route::post('employees', [EmployerController::class, 'store']);
        // Route::get('employees/{employee}', [EmployerController::class, 'show']);
        // Route::delete('employees/{employee}', [EmployerController::class, 'destroy']);

        Route::apiResource('employees', EmployerController::class);
    });
    
    Route::any('{any}', function () {
        return view('dashboard.employees.index');
    })->where('any', '.*');
});
