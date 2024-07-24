<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UkbmController;
use App\Http\Controllers\DataUkbmController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\UkmEssensialController;
use App\Http\Controllers\KegiatanPromKesController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\JenisPromosiKesehatanController;
use App\Http\Controllers\ukm_promkes\KegiatanPromosiKesehatanUmumDesaController;
use App\Http\Controllers\ukm_promkes\PencatatanKegiatanPromosiKesehatanUmumDesa;

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
    Route::get('management-users/edit/{level}/{id}', [UserManagementController::class, 'edit'])->name('admin-edit-management-users');
    Route::post('management-users/update/{id}', [UserManagementController::class, 'update'])->name('admin-update-management-users');
    Route::get('management-users/updatePassword/{id}', [UserManagementController::class, 'updatePassword'])->name('admin-updatePassword-management-users');
    Route::get('management-users/delete/{id}', [UserManagementController::class, 'delete'])->name('admin-delete-management-users');
    
    // Management Desa
    Route::get('management-desa', [DesaController::class, 'index'])->name('desa.index');
    Route::get('management-desa/create', [DesaController::class, 'create'])->name('desa.create');
    Route::post('management-desa/create', [DesaController::class, 'store'])->name('desa.store');
    Route::get('management-desa/{id}', [DesaController::class, 'edit'])->name('desa.edit');
    Route::post('management-desa/{id}', [DesaController::class, 'update'])->name('desa.update');
    Route::delete('management-desa/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');

    // Management UKBM
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm', [UkbmController::class, 'index'])->name('ukbm.index');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/create', [UkbmController::class, 'addJenisUkbm'])->name('ukbm.jenis.create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/create', [UkbmController::class, 'postJenisUkbm'])->name('ukbm.jenis.post');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/update/{id}', [UkbmController::class, 'editJenisUkbm'])->name('ukbm.jenis.edit');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/update/{id}', [UkbmController::class, 'updateJenisUkbm'])->name('ukbm.jenis.update');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/delete/{id}', [UkbmController::class, 'deleteJenisUkbm'])->name('ukbm.jenis.delete');
    
    // Management data UKBM
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/create', [DataUkbmController::class, 'create'])->name('ukbm.data-ukbm.create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/create', [DataUkbmController::class, 'store'])->name('ukbm.data-ukbm.store');

    // Management Jenis Program
    Route::get('ukm-essensial/divisi', [UkmEssensialController::class, 'index'])->name('ukm-essensial.index');
    Route::get('ukm-essensial/divisi/promosi-kesehatan', [UkmEssensialController::class, 'show'])->name('promkes.show');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan', [UkmEssensialController::class, 'showKegiatan'])->name('promkes.show.activity');
    

    Route::get('program-kegiatan-promkes-desa/index', [KegiatanPromosiKesehatanUmumDesaController::class, 'index'])->name('program-kegiatan-promkes-desa-index');
    Route::get('program-kegiatan-promkes-desa/create', [KegiatanPromosiKesehatanUmumDesaController::class, 'create'])->name('program-kegiatan-promkes-desa-create');
    Route::post('program-kegiatan-promkes-desa/store', [KegiatanPromosiKesehatanUmumDesaController::class, 'store'])->name('program-kegiatan-promkes-desa-store');
    Route::get('program-kegiatan-promkes-desa/edit/{id}', [KegiatanPromosiKesehatanUmumDesaController::class, 'edit'])->name('program-kegiatan-promkes-desa-edit');
    Route::post('program-kegiatan-promkes-desa/update/{id}', [KegiatanPromosiKesehatanUmumDesaController::class, 'update'])->name('program-kegiatan-promkes-desa-update');

    // Pencatatan Kegiatan Promosi Kesehatan Umum Desa 
    Route::get('pencatatan-program-kegiatan-promkes-desa/index/{id}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'index'])->name('pencatatan-program-kegiatan-promkes-desa-index');

});