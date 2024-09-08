<?php

use App\Http\Controllers\ukm_imunisasi\baduta\JenisImunisasiBadutaController;
use App\Http\Controllers\ukm_imunisasi\baduta\SasaranImunisasiBadutaController;
use App\Http\Controllers\ukm_imunisasi\imunisasi_bayi\JenisImunisasiBayiController;
use App\Http\Controllers\ukm_imunisasi\imunisasi_bayi\LaporanImunisasiBayiController;
use App\Http\Controllers\ukm_imunisasi\imunisasi_bayi\SasaranImunisasiBayiController;
use App\Http\Controllers\ukm_kia_gizi\KegiatanProgramKesehatanSekolahController;
use App\Http\Controllers\ukm_kia_gizi\KegiatanProgramKiaGiziController;
use App\Http\Controllers\ukm_kia_gizi\KelasSiswaController;
use App\Http\Controllers\ukm_kia_gizi\PencatatanKegiatanProgramKesehatanSekolahController;
use App\Http\Controllers\ukm_kia_gizi\PencatatanKegiatanProgramKiaGiziController;
use App\Http\Controllers\ukm_kia_gizi\ProgramKIAGiziController;
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
use App\Http\Controllers\PencatatanUkbmController;
use App\Http\Controllers\KegiatanPromKesController;
use App\Http\Controllers\PeriodePencatatanController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\JenisPromosiKesehatanController;
use App\Http\Controllers\KegiatanKeslingController;
use App\Http\Controllers\PencatatanKeslingController;
use App\Http\Controllers\PengendalianPenyakitController;
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
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm', [UkbmController::class, 'index'])->name('ukbm.jenis.index');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/create', [UkbmController::class, 'addJenisUkbm'])->name('ukbm.jenis.create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/create', [UkbmController::class, 'postJenisUkbm'])->name('ukbm.jenis.post');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/update/{id}', [UkbmController::class, 'editJenisUkbm'])->name('ukbm.jenis.edit');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/update/{id}', [UkbmController::class, 'updateJenisUkbm'])->name('ukbm.jenis.update');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/jenis-ukbm/delete/{id}', [UkbmController::class, 'deleteJenisUkbm'])->name('ukbm.jenis.delete');
    
    // Management data UKBM
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm', [DataUkbmController::class, 'index'])->name('ukbm.data-ukbm.index');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/create', [DataUkbmController::class, 'create'])->name('ukbm.data-ukbm.create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/create', [DataUkbmController::class, 'store'])->name('ukbm.data-ukbm.store');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/delete/{id}', [DataUkbmController::class, 'destroy'])->name('ukbm.data-ukbm.delete');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/edit/{id}', [DataUkbmController::class, 'edit'])->name('ukbm.data-ukbm.edit');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/update/{id}', [DataUkbmController::class, 'update'])->name('ukbm.data-ukbm.update');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/data-ukbm/updateStatus/{id}', [DataUkbmController::class, 'show'])->name('ukbm.data-ukbm.show');

    // Management Pencatatan data UKBM
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/report', [PencatatanUkbmController::class, 'indexReport'])->name('ukbm.pencatatan-ukbm.report');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}', [PencatatanUkbmController::class, 'index'])->name('ukbm.pencatatan-ukbm.index');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/create', [PencatatanUkbmController::class, 'create'])->name('ukbm.pencatatan-ukbm.create');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/create', [PencatatanUkbmController::class, 'store'])->name('ukbm.pencatatan-ukbm.store');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/edit/{id}', [PencatatanUkbmController::class, 'edit'])->name('ukbm.pencatatan-ukbm.edit');
    Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/update/{id}', [PencatatanUkbmController::class, 'update'])->name('ukbm.pencatatan-ukbm.update');
    Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/delete/{id}', [PencatatanUkbmController::class, 'destroy'])->name('ukbm.pencatatan-ukbm.delete');
    

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
    
    // Kegiatan Kesehatan Keliling
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan', [KegiatanKeslingController::class, 'index'])->name('kesling.kegiatan.index');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan/create', [KegiatanKeslingController::class, 'create'])->name('kesling.kegiatan.create');
    Route::post('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan/create', [KegiatanKeslingController::class, 'store'])->name('kesling.kegiatan.store');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan/{id}/edit', [KegiatanKeslingController::class, 'edit'])->name('kesling.kegiatan.edit');
    Route::post('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan/{id}/edit', [KegiatanKeslingController::class, 'update'])->name('kesling.kegiatan.update');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan/{id}/delete', [KegiatanKeslingController::class, 'destroy'])->name('kesling.kegiatan.delete');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/kegiatan/{id}/updateStatus', [KegiatanKeslingController::class, 'updateStatus'])->name('kesling.kegiatan.updateStatus');

    
    // Pencatatan Kegiatan Kesehatan Keliling
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/report', [PencatatanKeslingController::class, 'indexReport'])->name('kesling.kegiatan.report');
    Route::post('ukm-essensial/divisi/kesehatan-lingkungan/report/create', [PencatatanKeslingController::class, 'store'])->name('kesling.kegiatan.report.store');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/report/create', [PencatatanKeslingController::class, 'create'])->name('kesling.kegiatan.report.create');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/report/{id}/edit', [PencatatanKeslingController::class, 'edit'])->name('kesling.kegiatan.report.edit');
    Route::post('ukm-essensial/divisi/kesehatan-lingkungan/report/{id}/edit', [PencatatanKeslingController::class, 'update'])->name('kesling.kegiatan.report.update');
    Route::get('ukm-essensial/divisi/kesehatan-lingkungan/report/{id}/delete', [PencatatanKeslingController::class, 'destroy'])->name('kesling.kegiatan.report.delete');

    // PROGRAM KIA GIZI
    Route::get('pencatatan-program-kia-gizi/index', [ProgramKIAGiziController::class, 'index'])->name('program-kia-gizi-index');   
    Route::get('pencatatan-program-kia-gizi/create', [ProgramKIAGiziController::class, 'create'])->name('program-kia-gizi-create');   
    Route::post('pencatatan-program-kia-gizi/store', [ProgramKIAGiziController::class, 'store'])->name('program-kia-gizi-store');   
    Route::get('pencatatan-program-kia-gizi/edit/{id}', [ProgramKIAGiziController::class, 'edit'])->name('program-kia-gizi-edit');
    Route::post('pencatatan-program-kia-gizi/update/{id}', [ProgramKIAGiziController::class, 'update'])->name('program-kia-gizi-update');
    Route::get('pencatatan-program-kia-gizi/updateStatus/{id}', [ProgramKIAGiziController::class, 'updateStatus'])->name('program-kia-gizi-updateStatus');
    
    // Kegiatan PROGRAM GIZI KIA 
    Route::get('pencatatan-program-kia-gizi/kegiatan/index/{id}', [KegiatanProgramKiaGiziController::class, 'index'])->name('kegiatan-program-kia-gizi-index');
    Route::get('pencatatan-program-kia-gizi/kegiatan/create/{id}', [KegiatanProgramKiaGiziController::class, 'create'])->name('kegiatan-program-kia-gizi-create');
    Route::post('pencatatan-program-kia-gizi/kegiatan/store/{id}', [KegiatanProgramKiaGiziController::class, 'store'])->name('kegiatan-program-kia-gizi-store');
    Route::get('pencatatan-program-kia-gizi/kegiatan/edit/{id}/{idKegiatan}', [KegiatanProgramKiaGiziController::class, 'edit'])->name('kegiatan-program-kia-gizi-edit');
    Route::post('pencatatan-program-kia-gizi/kegiatan/update/{id}/{idKegiatan}', [KegiatanProgramKiaGiziController::class, 'update'])->name('kegiatan-program-kia-gizi-update');
    Route::get('pencatatan-program-kia-gizi/kegiatan/updateStatus/{idKegiatan}', [KegiatanProgramKiaGiziController::class, 'updateStatus'])->name('kegiatan-program-kia-gizi-updateStatus');

    // Pencatatan Kegiatan Program Gizi KIA
    Route::get('pencatatan-program-kia-gizi/kegiatan/pencatatan/index/{id}/{idKegiatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'index'])->name('pencatatan-kegiatan-program-kia-gizi-index');
    Route::get('pencatatan-program-kia-gizi/kegiatan/pencatatan/create/{id}/{idKegiatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'create'])->name('pencatatan-kegiatan-program-kia-gizi-create');
    Route::post('pencatatan-program-kia-gizi/kegiatan/pencatatan/store/{id}/{idKegiatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'store'])->name('pencatatan-kegiatan-program-kia-gizi-store');
    Route::get('pencatatan-program-kia-gizi/kegiatan/pencatatan/edit/{id}/{idKegiatan}/{idPencatatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'edit'])->name('pencatatan-kegiatan-program-kia-gizi-edit');
    Route::post('pencatatan-program-kia-gizi/kegiatan/pencatatan/update/{id}/{idKegiatan}/{idPencatatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'update'])->name('pencatatan-kegiatan-program-kia-gizi-update');
    Route::get('pencatatan-program-kia-gizi/kegiatan/pencatatan/destroy/{id}/{idKegiatan}/{idPencatatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'destroy'])->name('pencatatan-kegiatan-program-kia-gizi-destroy');
    Route::get('pencatatan-program-kia-gizi/kegiatan/pencatatan/archieve/{id}/{idKegiatan}', [PencatatanKegiatanProgramKiaGiziController::class, 'archieve'])->name('pencatatan-kegiatan-program-kia-gizi-archieve');
    
    // Kegiatan Program Usaha Kesehatan Sekolah 
    Route::get('kegiatan-program-kia-gizi/UKS/index', [KegiatanProgramKesehatanSekolahController::class, 'index'])->name('kegiatan-program-kia-gizi-UKS-index');
    Route::get('kegiatan-program-kia-gizi/UKS/create', [KegiatanProgramKesehatanSekolahController::class, 'create'])->name('kegiatan-program-kia-gizi-UKS-create');
    Route::post('kegiatan-program-kia-gizi/UKS/store', [KegiatanProgramKesehatanSekolahController::class, 'store'])->name('kegiatan-program-kia-gizi-UKS-store');
    Route::get('kegiatan-program-kia-gizi/UKS/edit/{id}', [KegiatanProgramKesehatanSekolahController::class, 'edit'])->name('kegiatan-program-kia-gizi-UKS-edit');
    Route::post('kegiatan-program-kia-gizi/UKS/update/{id}', [KegiatanProgramKesehatanSekolahController::class, 'update'])->name('kegiatan-program-kia-gizi-UKS-update');
    Route::get('kegiatan-program-kia-gizi/UKS/updateStatus/{id}', [KegiatanProgramKesehatanSekolahController::class, 'updateStatus'])->name('kegiatan-program-kia-gizi-UKS-updateStatus');
    
    
    // Kelas Siswa Controll 
    Route::get('kegiatan-program-kia-gizi/UKS/kelas-siswa/index', [KelasSiswaController::class, 'index'])->name('kegiatan-program-kia-gizi-UKS-kelas-siswa-index');
    Route::get('kegiatan-program-kia-gizi/UKS/kelas-siswa/create', [KelasSiswaController::class, 'create'])->name('kegiatan-program-kia-gizi-UKS-kelas-siswa-create');
    Route::post('kegiatan-program-kia-gizi/UKS/kelas-siswa/store', [KelasSiswaController::class, 'store'])->name('kegiatan-program-kia-gizi-UKS-kelas-siswa-store');
    Route::get('kegiatan-program-kia-gizi/UKS/kelas-siswa/edit/{idKelas}', [KelasSiswaController::class, 'edit'])->name('kegiatan-program-kia-gizi-UKS-kelas-siswa-edit');
    Route::post('kegiatan-program-kia-gizi/UKS/kelas-siswa/update/{idKelas}', [KelasSiswaController::class, 'update'])->name('kegiatan-program-kia-gizi-UKS-kelas-siswa-update');

    // Pencatatan Kegiatan Program UKS 
    Route::get('kegiatan-program-kia-gizi/pencatatan/UKS/index/{id}', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'index'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-index');
    Route::get('kegiatan-program-kia-gizi/pencatatan/UKS/create/{id}', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'create'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-create');
    Route::post('kegiatan-program-kia-gizi/pencatatan/UKS/store/{id}', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'store'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-store');
    Route::get('kegiatan-program-kia-gizi/pencatatan/UKS/edit/{id}/{idPencatatan}', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'edit'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-edit');
    Route::post('kegiatan-program-kia-gizi/pencatatan/UKS/update/{id}/{idPencatatan}', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'update'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-update');
    Route::get('kegiatan-program-kia-gizi/pencatatan/UKS/delete/{id}/{idPencatatan}', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'delete'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-delete');
    Route::get('kegiatan-program-kia-gizi/pencatatan/UKS/archieves/{id}/', [PencatatanKegiatanProgramKesehatanSekolahController::class, 'archieves'])->name('kegiatan-program-kia-gizi-pencatatan-UKS-archieves');
    
  
    // Pencegahan dan Pengendalian Penyakit
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit', [PengendalianPenyakitController::class, 'menu'])->name('pengendalian-penyakit.menu');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi', [PengendalianPenyakitController::class, 'imunisasi'])->name('pengendalian-penyakit.imunisasi');


    // P2M Imunisasi Bayi 
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/index', [SasaranImunisasiBayiController::class, 'index'])->name('pengendalian-penyakit-imunisai-imunisasi-bayi-index');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/create', [SasaranImunisasiBayiController::class, 'create'])->name('pengendalian-penyakit-imunisai-imunisasi-bayi-create');
    Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/store', [SasaranImunisasiBayiController::class, 'store'])->name('pengendalian-penyakit-imunisai-imunisasi-bayi-store');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/edit/{id}', [SasaranImunisasiBayiController::class, 'edit'])->name('pengendalian-penyakit-imunisai-imunisasi-bayi-edit');
    Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/update/{id}', [SasaranImunisasiBayiController::class, 'update'])->name('pengendalian-penyakit-imunisai-imunisasi-bayi-update');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/arsip/index', [SasaranImunisasiBayiController::class, 'archieves'])->name('pengendalian-penyakit-imunisai-bayi-arsip');

    
    // Jenis Imuniasi Bayi 
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/jenis_imunisasi/index', [JenisImunisasiBayiController::class, 'index'])->name('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-index');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/jenis_imunisasi/create', [JenisImunisasiBayiController::class, 'create'])->name('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-create');
    Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/jenis_imunisasi/store', [JenisImunisasiBayiController::class, 'store'])->name('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-store');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/jenis_imunisasi/edit/{id}', [JenisImunisasiBayiController::class, 'edit'])->name('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-edit');
    Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/jenis_imunisasi/update/{id}', [JenisImunisasiBayiController::class, 'update'])->name('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-update');
    Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi/imunisasi_bayi/jenis_imunisasi/updateStatus/{id}', [JenisImunisasiBayiController::class, 'updateStatus'])->name('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-updateStatus');
    
    // Laporan imunisasi bayi 
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/imunisasi-bayi/laporan/index/{id}', [LaporanImunisasiBayiController::class, 'index'])->name('P2-Laporan-Imunisasi');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/imunisasi-bayi/laporan/create/{id}', [LaporanImunisasiBayiController::class, 'create'])->name('P2-Laporan-Imunisasi-create');
    Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/imunisasi-bayi/laporan/store/{id}', [LaporanImunisasiBayiController::class, 'store'])->name('P2-Laporan-Imunisasi-store');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/imunisasi-bayi/laporan/edit/{id}/{idLaporan}', [LaporanImunisasiBayiController::class, 'edit'])->name('P2-Laporan-Imunisasi-edit');
    Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/imunisasi-bayi/laporan/update/{id}/{idLaporan}', [LaporanImunisasiBayiController::class, 'update'])->name('P2-Laporan-Imunisasi-update');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/imunisasi-bayi/laporan/destroy/{id}/{idLaporan}', [LaporanImunisasiBayiController::class, 'destroy'])->name('P2-Laporan-Imunisasi-destroy');    
    
    // IMUNISASI BADUTA 
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/index', [SasaranImunisasiBadutaController::class, 'index'])->name('sasaran-imunisasi-baduta-index');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/create', [SasaranImunisasiBadutaController::class, 'create'])->name('sasaran-imunisasi-baduta-create');
    Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/store', [SasaranImunisasiBadutaController::class, 'store'])->name('sasaran-imunisasi-baduta-store');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/edit/{id}', [SasaranImunisasiBadutaController::class, 'edit'])->name('sasaran-imunisasi-baduta-edit');
    Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/update/{id}', [SasaranImunisasiBadutaController::class, 'update'])->name('sasaran-imunisasi-baduta-update');
    
    // Jenis Imunisasi Baduta 
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/jenis_imunisasi/index', [JenisImunisasiBadutaController::class, 'index'])->name('jenis-imunisasi-baduta-index');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/jenis_imunisasi/create', [JenisImunisasiBadutaController::class, 'create'])->name('jenis-imunisasi-baduta-create');
    Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/jenis_imunisasi/store', [JenisImunisasiBadutaController::class, 'store'])->name('jenis-imunisasi-baduta-store');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/jenis_imunisasi/edit/{id}', [JenisImunisasiBadutaController::class, 'edit'])->name('jenis-imunisasi-baduta-edit');
    Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/jenis_imunisasi/update/{id}', [JenisImunisasiBadutaController::class, 'update'])->name('jenisupdate-imunisasi-baduta-update');
    Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/jenis_imunisasi/updateStatus/{id}', [JenisImunisasiBadutaController::class, 'updateStatus'])->name('jenis-imunisasi-baduta-updateStatus');
    

});