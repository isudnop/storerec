<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SellRecord;
use App\Models\Sales;
use App\Models\DailyRemark;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function saveRecord(Request $request) {
        $params = $request->all();
        
        $rec = new SellRecord();
        
        $rec->sell_amount = $params['sell_amount'];
        $rec->sales_id = $params['sales_id'];
        $rec->department_id = $params['department_id'];
        $rec->save();
        
        $daily = DailyRemark::firstOrCreate(['date_of_amount' => date('Y-m-d')]);
        $daily->total_amount = $daily->total_amount + $params['sell_amount'];
        $daily->save();
        
        $latestRecord = $rec->getFiveLatestRec();
        
        return redirect()->route('record-amount')
        ->with([
            'success' => true
        ]); 
    }
    
    public function showMain(Request $request) {
        $rec = new SellRecord();
        
        $success = $request->get('success') ?? false;
        
        $latestRecord = $rec->getFiveLatestRec();
        
        return view('main')->with([
            'latest_record' => $latestRecord,
            'success' => $success
        ]);
    }
    
    public function backOfficeShowDailyReport(Request $request)
    {
        $labelColor = ['primary', 'success', 'info', 'warning'];
        $params = $request->only('date');
        $date   = $params['date'] ?? date('Y-m-d');
        $rec    = new SellRecord();
        $totalDetail = [];
        
        $totalToday = $rec->getTotalByDate($date);
        $totalDep = $rec->getTotalDepartmentByDate($date);
        $totalSale = $rec->getTotalSaleByDate($date);
        foreach ($totalSale as $ts) {
            $totalDetail[$ts->sales_id] = $rec->getSellDetailOfSaleByDate($ts->sales_id, $date);
        }
        return view('backoffice-daily-report')->with([
            'totalToday' => $totalToday,
            'totalDep' => $totalDep,
            'totalSale' => $totalSale,
            'totalDetail' => $totalDetail,
            'labelColor' => $labelColor,
            'currentDate' => $date
        ]);
    }
    
    public function backOfficeShowSummaryReport(Request $request)
    {
        for($i=0 ; $i < 30 ; $i++){
            $graphData[$i] = rand(40000, 60000);
            $graphLabel[$i] = "\"test-str-" . $i . "\"";
        }
        return view('backoffice-summary-report')->with([
            'graphData' => $graphData,
            'graphLabel' => $graphLabel
        ]);
    }
}
