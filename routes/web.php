<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DesaController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware'=> ['auth', 'ceklevel:Admin']], function (){
    Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');

    // Management User
    Route::get('management-users/{level}', [UserManagementController::class, 'index'])->name('admin-management-users');
    Route::get('management-users/add/{level}', [UserManagementController::class, 'add'])->name('admin-add-management-users');
    Route::post('management-users/store/{level}', [UserManagementController::class, 'store'])->name('admin-store-management-users');
    Route::get('management-users/edit/{level}', [UserManagementController::class, 'edit'])->name('admin-edit-management-users');
    

    // Management Desa
    Route::get('management-desa', [DesaController::class, 'index'])->name('desa.index');
    Route::get('management-desa/create', [DesaController::class, 'create'])->name('desa.create');
    Route::post('management-desa/create', [DesaController::class, 'store'])->name('desa.store');
    Route::get('management-desa/{id}', [DesaController::class, 'edit'])->name('desa.edit');
    Route::post('management-desa/{id}', [DesaController::class, 'update'])->name('desa.update');
    Route::delete('management-desa/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');
});