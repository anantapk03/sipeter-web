<?php

use App\Http\Controllers\ukm_promkes\KegiatanProgramDivisiPromkesController;
use App\Http\Controllers\ukm_promkes\PencatatanKegiatanProgramPromkesController;
use App\Http\Controllers\ukm_promkes\ProgramDivisiPromkesController;
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

    // Management Program Divisi Promosi Kesehatan 
    Route::get('ukm-essensial/divisi/promosi-kesehatan-1', [ProgramDivisiPromkesController::class, 'index'])->name('program-divisi-promosi-kesehatan');
    Route::get('ukm-essensial/divisi/promosi-kesehatan-1/create', [ProgramDivisiPromkesController::class, 'create'])->name('program-divisi-promosi-kesehatan-create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan-1/store', [ProgramDivisiPromkesController::class, 'store'])->name('program-divisi-promosi-kesehatan-store');
    Route::get('ukm-essensial/divisi/promosi-kesehatan-1/edit/{id}', [ProgramDivisiPromkesController::class, 'edit'])->name('program-divisi-promosi-kesehatan-edit');
    Route::post('ukm-essensial/divisi/promosi-kesehatan-1/update/{id}', [ProgramDivisiPromkesController::class, 'update'])->name('program-divisi-promosi-kesehatan-update');
    Route::get('ukm-essensial/divisi/promosi-kesehatan-1/updateStatus/{id}', [ProgramDivisiPromkesController::class, 'updateStatus'])->name('program-divisi-promosi-kesehatan-updateStatus');

    // Management Kegiatan Program point B dst. 
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/index/{id}', [KegiatanProgramDivisiPromkesController::class, 'index'])->name('kegiatan-program-divisi-promkes-index');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/create/{id}', [KegiatanProgramDivisiPromkesController::class, 'create'])->name('kegiatan-program-divisi-promkes-create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/store/{id}', [KegiatanProgramDivisiPromkesController::class, 'store'])->name('kegiatan-program-divisi-promkes-store');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/edit/{id}/{idKegiatan}', [KegiatanProgramDivisiPromkesController::class, 'edit'])->name('kegiatan-program-divisi-promkes-edit');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/update/{id}/{idKegiatan}', [KegiatanProgramDivisiPromkesController::class, 'update'])->name('kegiatan-program-divisi-promkes-update');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/updateStatus/{id}/{idKegiatan}', [KegiatanProgramDivisiPromkesController::class, 'updateStatus'])->name('kegiatan-program-divisi-promkes-updateStatus');
    
    // Report Activity Promkes 
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/report/{id}/{idKegiatan}', [PencatatanKegiatanProgramPromkesController::class, 'indexMonth'])->name('report-activity-promkes-month');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/report/create/{id}/{idKegiatan}', [PencatatanKegiatanProgramPromkesController::class, 'create'])->name('report-create-activity-promkes-month');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/report/store/{id}/{idKegiatan}', [PencatatanKegiatanProgramPromkesController::class, 'store'])->name('report-store-activity-promkes-month');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/report/destroy/{id}/{idKegiatan}/{idPencatatan}', [PencatatanKegiatanProgramPromkesController::class, 'destroy'])->name('report-destroy-activity-promkes-month');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/report/edit/{id}/{idKegiatan}/{idPencatatan}', [PencatatanKegiatanProgramPromkesController::class, 'edit'])->name('report-edit-activity-promkes-month');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/report/update/{id}/{idKegiatan}/{idPencatatan}', [PencatatanKegiatanProgramPromkesController::class, 'update'])->name('report-update-activity-promkes-month');
    
    

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
    Route::get('program-kegiatan-promkes-desa/updateStatus/{id}', [KegiatanPromosiKesehatanUmumDesaController::class, 'updateStatus'])->name('program-kegiatan-promkes-desa-updateStatus');
    
    // Pencatatan Kegiatan Promosi Kesehatan Umum Desa 
    Route::get('pencatatan-program-kegiatan-promkes-desa/index/{id}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'index'])->name('pencatatan-program-kegiatan-promkes-desa-index');

    Route::get('pencatatan-program-kegiatan-promkes-desa/create/{id}/{month}/{status}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'indexReport'])->name('pencatatan-program-kegiatan-promkes-desa-create');
    Route::get('pencatatan-program-kegiatan-promkes-desa/createReport/{id}/{month}/{status}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'createReport'])->name('pencatatan-program-kegiatan-promkes-desa-createReport');
    Route::post('pencatatan-program-kegiatan-promkes-desa/storeReport/{id}/{month}/{status}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'storeReport'])->name('pencatatan-program-kegiatan-promkes-desa-storeReport');
    Route::get('pencatatan-program-kegiatan-promkes-desa/editReport/{id}/{month}/{status}/{idReport}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'editReport'])->name('pencatatan-program-kegiatan-promkes-desa-editReport');
    Route::post('pencatatan-program-kegiatan-promkes-desa/updateReport/{id}/{month}/{status}/{idReport}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'updateReport'])->name('pencatatan-program-kegiatan-promkes-desa-updateReport');
    Route::get('pencatatan-program-kegiatan-promkes-desa/deleteReport/{idReport}', [PencatatanKegiatanPromosiKesehatanUmumDesa::class, 'deleteReport'])->name('pencatatan-program-kegiatan-promkes-desa-deleteReport');
    
    


});