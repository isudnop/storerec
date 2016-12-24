<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SellRecord;
use App\Models\Sales;
use Illuminate\Http\Request;

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
        
        $latestRecord = $rec->getFiveLatestRec();
        
        return view('main')->with([
            'success' => true,
            'latest_record' => $latestRecord
        ]); 
    }
    
    public function showMain() {
        $rec = new SellRecord();
        
        $latestRecord = $rec->getFiveLatestRec();
        
        return view('main')->with([
            'success' => true,
            'latest_record' => $latestRecord
        ]);
    }
    
    public function backOfficeDailyReport(Request $request)
    {
        $labelColor = ['primary', 'success', 'info', 'warning'];
        $params = $request->only('date');
        $date   = $params['date'] ?? date('Y-m-d');
        $rec    = new SellRecord();
        
        
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
            'labelColor' => $labelColor
        ]);
    }
}
