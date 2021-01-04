<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);



Route::group(['middleware' => ['auth', 'cekrole:admin']], function () {
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/create', [SiswaController::class, 'create']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit']);
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy']);
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show']);
    Route::post('/siswa/{siswa}/add_nilai', [SiswaController::class, 'add_nilai']);
});

Route::group(['middleware' => ['auth', 'cekrole:admin,siswa']], function () {
    Route::get('/dashboards', [DashboardsController::class, 'index']);
});


