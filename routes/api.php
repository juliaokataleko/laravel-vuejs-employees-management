<?php

use App\Http\Controllers\API\EmployeeDataController;
use App\Http\Controllers\API\EmployerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['web']], function () {
//     Route::get('employees/countries',[EmployeeDataController::class, 'countries']);
//     Route::get('employees/{country}/states', [EmployeeDataController::class, 'states']);
//     Route::get('employees/{state}/cities', [EmployeeDataController::class, 'cities']);
//     Route::get('employees/departments', [EmployeeDataController::class, 'departments']);

//     // Route::get('employees', [EmployerController::class, 'index']);
//     // Route::post('employees', [EmployerController::class, 'store']);
//     // Route::get('employees/{employee}', [EmployerController::class, 'show']);
//     // Route::delete('employees/{employee}', [EmployerController::class, 'destroy']);

//     Route::apiResource('employees', EmployerController::class);
// });