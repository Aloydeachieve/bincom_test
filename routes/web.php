<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/polling-unit/{id}', [ResultController::class, 'showPollingUnit'])->name('polling.unit.result');
Route::get('/lga-result', [ResultController::class, 'showLgaResult']);
Route::get('/add-result', [ResultController::class, 'create']);
Route::post('/add-result', [ResultController::class, 'store']);

Route::get('/get-lgas/{state_id}', [ResultController::class, 'getLgas']);
Route::get('/get-wards/{lga_id}', [ResultController::class, 'getWards']);
Route::get('/get-polling-units/{ward_id}', [ResultController::class, 'getPollingUnits']);

