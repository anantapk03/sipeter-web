<?php

namespace App\Http\Controllers\report;

use App\Helpers\DivisiHelper;
use App\helpers\MonthHelper;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\KegiatanProgramKiaGizi;
use App\Models\ListReportKiaGizi;
use App\Models\ListReportUksKiaGizi;
use App\Models\ProgramKiaGizi;
use App\Models\ReportByMonthGiziKia;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KiaGiziReportController extends Controller
{
    public function index(){
        $isAlredyGenerateListUks = false;
        $isAlreadyGenerateListKiaGizi = false;
        // Find id parent report
        $data = $this->findDataReportByMonthAndYear();
        if($data == null){
            // add new data in Parent table 
            $data = $this->saveDataReportByMonth();
             // Cek apakah $data adalah instance dari RedirectResponse
            if ($data instanceof RedirectResponse) {
                return $data; // Jika ya, kembalikan redirect ini
            }
        }
        $idReportByMonth = $data->id;

        $dataListReportUks = $this->findListDataReportKiaGizi($idReportByMonth);
        $dataListKiaGizi = $this->findListDataReportKiaGizi($idReportByMonth);
        if($dataListKiaGizi->isNotEmpty()){
            $isAlreadyGenerateListKiaGizi = true;
        }
        if($dataListReportUks->isNotEmpty()){
            $isAlredyGenerateListUks = true;
        }

        $monthName = MonthHelper::getMonth(MonthHelper::logicGetMonth());
        $currentYear = MonthHelper::checkYear();

        $payloadData = [
            'monthName'=>$monthName,
            'tahun'=>$currentYear,
            'idReport'=>$idReportByMonth, 
            'listUks'=>$dataListReportUks, 
            'listKiaGizi'=>$dataListKiaGizi, 
            'isAlreadyGenerateUks'=>$isAlredyGenerateListUks, 
            'isAlreadyGenerateKiaGizi'=>$isAlreadyGenerateListKiaGizi
        ];

        return view('report.kia-gizi.index', $payloadData);
        
    }

    public function findDataReportByMonthAndYear(){
        $currentMonth = MonthHelper::logicGetMonth();
        $currentYear = MonthHelper::checkYear();
        try{
            $data = ReportByMonthGiziKia::where('bulan', $currentMonth)->where('tahun', $currentYear)->first();
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function saveDataReportByMonth(){
        $data = new ReportByMonthGiziKia();
        $currentMonth = MonthHelper::logicGetMonth();
        $currentYear = MonthHelper::checkYear();
        $data->isAcceptedByKepus = false;
        $data->isAcceptedByPetugas = false;
        $data->bulan = $currentMonth;
        $data->tahun = $currentYear;

        try{
            $data->save();
            return $data;
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function findListDataReportUks($idReportByMonth){
        try{
            $data = ListReportUksKiaGizi::where('idReportByMonthGiziKia', $idReportByMonth)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function findListDataReportKiaGizi($idReportByMonth){
        try{
            $data = ListReportKiaGizi::where('idReportByMonthGiziKia', $idReportByMonth)->get();
            return $data ;
        } catch(Exception $e){
            return collect();
        }
    }


    public function generateForViewKiaGiziReport($idReportByMonth){
        $desa = Desa::all();
        $dataListInReport = $this->findListDataReportKiaGizi($idReportByMonth);
        $desa = $desa->pluck('id')->toArray();
        $program = ProgramKiaGizi::where('isActive', true)->get();
        $listIdProgram = $program->pluck('id')->toArray();

        foreach($program as $programItem){
            $dataKegiatan = $this->getKegiatanInProgramKiaGiziById($programItem->id);
            
            
        }


        /*
        $data = [
            [
                namaProgram => namaProgram1,
                laporan => [
                    [
                        [
                            namaKegiatan => namaKegiatanProgram1_1,
                            hasil => [0, 0, 1] (urutan list berdasarkan urutan list desa),
                        ],
                        [
                            namaKegiatan => namaKegiatanProgram1_2,
                            hasil => [0, 0, 1] (urutan list berdasarkan urutan list desa),
                        ],
                        [
                            namaKegiatan => namaKegiatanProgram1_1,
                            hasil => [0, 0, 1] (urutan list berdasarkan urutan list desa),
                        ],
                        
                    ]
                ]
            ], 
            [
                namaProgram => namaProgram1,
                laporan => [
                    [
                        [
                            namaKegiatan => namaKegiatanProgram1_1,
                            hasil => [0, 0, 1] (urutan list berdasarkan urutan list desa),
                        ],
                        [
                            namaKegiatan => namaKegiatanProgram1_2,
                            hasil => [0, 0, 1] (urutan list berdasarkan urutan list desa),
                        ],
                        [
                            namaKegiatan => namaKegiatanProgram1_1,
                            hasil => [0, 0, 1] (urutan list berdasarkan urutan list desa),
                        ],
                        
                    ]
                ]
            ], 
        ]
        */

    }

    public function getKegiatanInProgramKiaGiziById($idProgramKiaGizi){
        try{
            $data = KegiatanProgramKiaGizi::where("idProgramKiaGizi", $idProgramKiaGizi)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getInfoReportBy(){

    }
}
