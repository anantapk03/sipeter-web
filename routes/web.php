<?php

use App\Http\Controllers\admin\AccessFeaturesController;
use App\Http\Controllers\ukm_imunisasi\baduta\JenisImunisasiBadutaController;
use App\Http\Controllers\ukm_imunisasi\baduta\LaporanImunisasiBadutaController;
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
use App\Http\Controllers\ukm_p2\CategoryP2Controller;
use App\Http\Controllers\ukm_p2\ProgramP2Controller;
use App\Http\Controllers\ukm_p2\KegiatanProgramP2Controller;
use App\Http\Controllers\ukm_p2\LaporanKegiatanProgramP2Controller;
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
use App\Http\Controllers\KegiatanKeslingController;
use App\Http\Controllers\KegiatanPromKesController;
use App\Http\Controllers\JenisImunisasiWusController;
use App\Http\Controllers\PencatatanKeslingController;
use App\Http\Controllers\SasaranImunisasiWusController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\PengendalianPenyakitController;
use App\Http\Controllers\JenisPromosiKesehatanController;
use App\Http\Controllers\PencatatanWusController;
use App\Http\Controllers\ukm_promkes\KegiatanPromosiKesehatanUmumDesaController;
use App\Http\Controllers\ukm_promkes\PencatatanKegiatanPromosiKesehatanUmumDesa;
use App\Helpers\DivisiHelper;


Route::get('/', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::group(['middleware'=> ['auth', 'ceklevel:Petugas UKM,Admin']], function (){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::get('ukm-essensial/divisi', [UkmEssensialController::class, 'index'])->name('ukm-essensial.index');

    Route::group(['middleware'=>['checkAccessFeatures:'.DivisiHelper::ADMIN]], function (){
        // Management User
        Route::get('management-users/{level}', [UserManagementController::class, 'index'])->name('admin-management-users');
        Route::get('management-users/add/{level}', [UserManagementController::class, 'add'])->name('admin-add-management-users');
        Route::post('management-users/store/{level}', [UserManagementController::class, 'store'])->name('admin-store-management-users');
        Route::get('management-users/edit/{level}/{id}', [UserManagementController::class, 'edit'])->name('admin-edit-management-users');
        Route::post('management-users/update/{id}', [UserManagementController::class, 'update'])->name('admin-update-management-users');
        Route::get('management-users/updatePassword/{id}', [UserManagementController::class, 'updatePassword'])->name('admin-updatePassword-management-users');
        Route::get('management-users/delete/{id}', [UserManagementController::class, 'delete'])->name('admin-delete-management-users');

        // Management Features Access
        Route::get('management-features/index/{idUser}', [AccessFeaturesController::class, 'index'])->name('management-features-index');
        Route::get('management-features/create/{idUser}', [AccessFeaturesController::class, 'create'])->name('management-features-create');
        Route::post('management-features/store/{idUser}', [AccessFeaturesController::class, 'store'])->name('management-features-store');
        Route::get('management-features/edit/{idUser}/{idAccessFeature}', [AccessFeaturesController::class, 'edit'])->name('management-features-edit');
        Route::post('management-features/update/{idUser}/{idAccessFeature}', [AccessFeaturesController::class, 'update'])->name('management-features-update');
        Route::get('management-features/editLeader/{idAccessFeature}', [AccessFeaturesController::class, 'editLeader'])->name('management-features-editLeader');
        Route::get('management-features/destroy/{idAccessFeature}', [AccessFeaturesController::class, 'destroy'])->name('management-features-destroy');
        
        // Management Desa
        Route::get('management-desa', [DesaController::class, 'index'])->name('desa.index');
        Route::get('management-desa/create', [DesaController::class, 'create'])->name('desa.create');
        Route::post('management-desa/create', [DesaController::class, 'store'])->name('desa.store');
        Route::get('management-desa/{id}', [DesaController::class, 'edit'])->name('desa.edit');
        Route::post('management-desa/{id}', [DesaController::class, 'update'])->name('desa.update');
        Route::delete('management-desa/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');
    });

    Route::group(['middleware'=>['checkAccessFeatures:'.DivisiHelper::PROMOSI_KESEHATAN.','.DivisiHelper::ADMIN]], function(){
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
        

        // Management Jenis Program
        Route::get('ukm-essensial/divisi/promosi-kesehatan', [UkmEssensialController::class, 'show'])->name('promkes.show');
        Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan', [UkmEssensialController::class, 'showKegiatan'])->name('promkes.show.activity');
        
        Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/report', [PencatatanUkbmController::class, 'indexReport'])->name('ukbm.pencatatan-ukbm.report');
        Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}', [PencatatanUkbmController::class, 'index'])->name('ukbm.pencatatan-ukbm.index');
        Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/create', [PencatatanUkbmController::class, 'create'])->name('ukbm.pencatatan-ukbm.create');
        Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/create', [PencatatanUkbmController::class, 'store'])->name('ukbm.pencatatan-ukbm.store');
        Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/edit/{id}', [PencatatanUkbmController::class, 'edit'])->name('ukbm.pencatatan-ukbm.edit');
        Route::post('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/update/{id}', [PencatatanUkbmController::class, 'update'])->name('ukbm.pencatatan-ukbm.update');
        Route::get('ukm-essensial/divisi/promosi-kesehatan/kegiatan/ukbm/report/pencatatan-data-ukbm/{month}/{status}/delete/{id}', [PencatatanUkbmController::class, 'destroy'])->name('ukbm.pencatatan-ukbm.delete');

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

    Route::group(['middleware'=>['checkAccessFeatures:'.DivisiHelper::KESEHATAN_LINGKUNGAN.','.DivisiHelper::ADMIN]], function(){
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
    });

    Route::group(['middleware'=>['checkAccessFeatures:'.DivisiHelper::KESEHATAN_IBU_ANAK_GIZI.','.DivisiHelper::ADMIN]], function(){
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
    });

    Route::group(['middleware'=>['checkAccessFeatures:'.DivisiHelper::PENCEGAHAN_PENGENDALIAN_PENYAKIT.','.DivisiHelper::ADMIN]], function(){
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
        
        // Laporan Imunisasi Baduta
        Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/laporan/index/{id}', [LaporanImunisasiBadutaController::class, 'index'])->name('laporan-imunisasi-baduta-index');
        Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/laporan/create/{id}', [LaporanImunisasiBadutaController::class, 'create'])->name('laporan-imunisasi-baduta-create');
        Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/laporan/store/{id}', [LaporanImunisasiBadutaController::class, 'store'])->name('laporan-imunisasi-baduta-store');
        Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/laporan/edit/{id}/{idLaporan}', [LaporanImunisasiBadutaController::class, 'edit'])->name('laporan-imunisasi-baduta-edit');
        Route::post('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/laporan/update/{id}/{idLaporan}', [LaporanImunisasiBadutaController::class, 'update'])->name('laporan-imunisasi-baduta-update');
        Route::get('/ukm-essensial/pengendalian-penyakit/imunisasi/baduta/laporan/destroy/{id}/{idLaporan}', [LaporanImunisasiBadutaController::class, 'destroy'])->name('laporan-imunisasi-baduta-destroy');

        // Category P2
        Route::get('/ukm-essensial/pengendalian-penyakit/category/index', [CategoryP2Controller::class, 'index'])->name('category-p2-index');
        Route::get('/ukm-essensial/pengendalian-penyakit/category/create', [CategoryP2Controller::class, 'create'])->name('category-p2-create');
        Route::post('/ukm-essensial/pengendalian-penyakit/category/store', [CategoryP2Controller::class, 'store'])->name('category-p2-store');
        Route::get('/ukm-essensial/pengendalian-penyakit/category/edit/{id}', [CategoryP2Controller::class, 'edit'])->name('category-p2-edit');
        Route::post('/ukm-essensial/pengendalian-penyakit/category/update/{id}', [CategoryP2Controller::class, 'update'])->name('category-p2-update');
        Route::get('/ukm-essensial/pengendalian-penyakit/category/updateStatus/{id}', [CategoryP2Controller::class, 'updateStatus'])->name('category-p2-updateStatus');
        
        // Program P2 
        Route::get('/ukm-essensial/pengendalian-penyakit/program/index/{id}', [ProgramP2Controller::class, 'index'])->name('program-p2-index');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/create/{id}', [ProgramP2Controller::class, 'create'])->name('program-p2-create');
        Route::post('/ukm-essensial/pengendalian-penyakit/program/store/{id}', [ProgramP2Controller::class, 'store'])->name('program-p2-store');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/edit/{id}/{idProgram}', [ProgramP2Controller::class, 'edit'])->name('program-p2-edit');
        Route::post('/ukm-essensial/pengendalian-penyakit/program/update/{id}/{idProgram}', [ProgramP2Controller::class, 'update'])->name('program-p2-update');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/updateStatus/{id}/{idProgram}', [ProgramP2Controller::class, 'updateStatus'])->name('program-p2-updateStatus');
        
        
        // Kegiatan P2 
        Route::get('/ukm-essensial/pengendalian-penyakit/program/kegiatan/index/{id}', [KegiatanProgramP2Controller::class, 'index'])->name('kegiatan-p2-index');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/kegiatan/create/{id}', [KegiatanProgramP2Controller::class, 'create'])->name('kegiatan-p2-create');
        Route::post('/ukm-essensial/pengendalian-penyakit/program/kegiatan/store/{id}', [KegiatanProgramP2Controller::class, 'store'])->name('kegiatan-p2-store');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/kegiatan/edit/{id}/{idKegiatan}', [KegiatanProgramP2Controller::class, 'edit'])->name('kegiatan-p2-edit');
        Route::post('/ukm-essensial/pengendalian-penyakit/program/kegiatan/update/{id}/{idKegiatan}', [KegiatanProgramP2Controller::class, 'update'])->name('kegiatan-p2-update');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/kegiatan/updateStatus/{id}/{idKegiatan}', [KegiatanProgramP2Controller::class, 'updateStatus'])->name('kegiatan-p2-updateStatus');
        

        // Laporan P2 
        Route::get('/ukm-essensial/pengendalian-penyakit/program/laporan/{id}', [LaporanKegiatanProgramP2Controller::class, 'index'])->name('laporan-kegiatan-program-p2');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/laporan/create/{id}', [LaporanKegiatanProgramP2Controller::class, 'create'])->name('laporan-kegiatan-program-p2-create');
        Route::post('/ukm-essensial/pengendalian-penyakit/program/laporan/store/{id}', [LaporanKegiatanProgramP2Controller::class, 'store'])->name('laporan-kegiatan-program-p2-store');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/laporan/edit/{id}/{idPencatatan}', [LaporanKegiatanProgramP2Controller::class, 'edit'])->name('laporan-kegiatan-program-p2-edit');
        Route::post('/ukm-essensial/pengendalian-penyakit/program/laporan/update/{id}/{idPencatatan}', [LaporanKegiatanProgramP2Controller::class, 'update'])->name('laporan-kegiatan-program-p2-update');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/laporan/destroy/{id}/{idPencatatan}', [LaporanKegiatanProgramP2Controller::class, 'destroy'])->name('laporan-kegiatan-program-p2-destroy');
        Route::get('/ukm-essensial/pengendalian-penyakit/program/laporan/history/{id}', [LaporanKegiatanProgramP2Controller::class, 'history'])->name('laporan-kegiatan-program-p2-history');
      
        // Imunisasi WUS
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus', [PengendalianPenyakitController::class, 'imunisasi_wus'])->name('imunisasi-wus.index');

        // Jenis
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis', [JenisImunisasiWusController::class, 'index'])->name('imunisasi-wus.jenis');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis/create', [JenisImunisasiWusController::class, 'create'])->name('imunisasi-wus.jenis.create');
        Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis/create', [JenisImunisasiWusController::class, 'store'])->name('imunisasi-wus.jenis.store');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis/{id}/edit', [JenisImunisasiWusController::class, 'edit'])->name('imunisasi-wus.jenis.edit');
        Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis/{id}/edit', [JenisImunisasiWusController::class, 'update'])->name('imunisasi-wus.jenis.update');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis/{id}/delete', [JenisImunisasiWusController::class, 'destroy'])->name('imunisasi-wus.jenis.delete');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/jenis/{id}/updateStatus', [JenisImunisasiWusController::class, 'updateStatus'])->name('imunisasi-wus.jenis.status');

            // Sasaran
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran', [SasaranImunisasiWusController::class, 'index'])->name('imunisasi-wus.sasaran');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/create', [SasaranImunisasiWusController::class, 'create'])->name('imunisasi-wus.sasaran.create');
        Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/create', [SasaranImunisasiWusController::class, 'store'])->name('imunisasi-wus.sasaran.store');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{id}/edit', [SasaranImunisasiWusController::class, 'edit'])->name('imunisasi-wus.sasaran.edit');
        Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{id}/edit', [SasaranImunisasiWusController::class, 'update'])->name('imunisasi-wus.sasaran.update');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{id}/delete', [SasaranImunisasiWusController::class, 'destroy'])->name('imunisasi-wus.sasaran.delete');

        // Laporan
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{idSasaran}/laporan', [PencatatanWusController::class, 'index'])->name('imunisasi-wus.laporan.index');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{idSasaran}/laporan/create', [PencatatanWusController::class, 'create'])->name('imunisasi-wus.laporan.create');
        Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{idSasaran}/laporan/create', [PencatatanWusController::class, 'store'])->name('imunisasi-wus.laporan.post');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{idSasaran}/laporan/edit/{id}', [PencatatanWusController::class, 'edit'])->name('imunisasi-wus.laporan.edit');
        Route::post('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{idSasaran}/laporan/edit/{id}', [PencatatanWusController::class, 'update'])->name('imunisasi-wus.laporan.update');
        Route::get('/ukm-essensial/divisi/pengendalian-penyakit/imunisasi-wus/sasaran/{idSasaran}/laporan/delete/{id}', [PencatatanWusController::class, 'destroy'])->name('imunisasi-wus.laporan.delete');

    });
    
});