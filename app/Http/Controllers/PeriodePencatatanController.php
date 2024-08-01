<?php

namespace App\Http\Controllers;

use App\Models\PeriodePencatatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodePencatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        function getReorderedMonths($currentMonth) {
            $months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
        
            $currentMonthIndex = array_search($currentMonth, $months);
        
            return array_merge(
                array_slice($months, $currentMonthIndex),
                array_slice($months, 0, $currentMonthIndex)
            );
        }
        
        $currentMonth = Carbon::now()->format('F');
        $reorderedMonths = getReorderedMonths($currentMonth);
        
        // Fetch all records
        $data = PeriodePencatatan::all();
        
        // Create a mapping for the month numbers
        $monthNumbers = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];
        
        // Get the current month number
        $currentMonthNumber = Carbon::now()->month;
        
        // Sort the data based on the reordered months array
        $data = $data->sort(function ($a, $b) use ($reorderedMonths) {
            $monthA = array_search($a->bulan, $reorderedMonths);
            $monthB = array_search($b->bulan, $reorderedMonths);
        
            return $monthA - $monthB;
        });
        
        // Check if the month is before the current month to disable the button
        foreach ($data as $datas) {
            $recordMonthNumber = $monthNumbers[$datas->bulan];
            $datas->is_disabled = $recordMonthNumber < $currentMonthNumber;
            $datas->save();
        }

        #dd($bulan);
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.periode.report', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // translate bulan kedalam bahasa inggris
        $months = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        // Get the month from the request
        $requestMonth = $request->bulan;

        // Translate the month to English
        $englishMonth = $months[$requestMonth] ?? $requestMonth; // Use the mapping to get the English month name

        PeriodePencatatan::create([
            'bulan' => $englishMonth,
            'tahun' => $request->tahun,
            'is_disabled' => 0
        ]);

        return redirect()->route('ukbm.pencatatan-ukbm.report');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
