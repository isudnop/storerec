<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SellRecord;
use App\Models\Sales;
use App\Models\DailySummary;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function saveRecord(Request $request) {
        
        $this->validate($request, [
            'sell_amount' => 'bail|required|integer',
            'sales_id' => 'bail|required|integer|exists:Sales,id',
            'department_id' => 'bail|required|integer|exists:Department,id',
        ]);
        
        $params = $request->all();
        
        $rec = new SellRecord();
        
        $rec->sell_amount = $params['sell_amount'];
        $rec->sales_id = $params['sales_id'];
        $rec->department_id = $params['department_id'];
        $rec->save();
        
        $daily = DailySummary::firstOrCreate(['date_of_amount' => date('Y-m-d') , 'department_id' => $params['department_id']]);
        $daily->total_amount = $daily->total_amount + $params['sell_amount'];
        $daily->save();
        
        $latestRecord = $rec->getFiveLatestRec();
        
        return view('main')->with([
            'latest_record' => $latestRecord
            ])->withSuccess(true); 
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
        if(empty(Cookie::get('authAdmin')) || Cookie::get('authAdmin') !== env('COOKIE_VALUE')){    
            return redirect()->route('show-login');
        }
        
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
        if(empty(Cookie::get('authAdmin')) || Cookie::get('authAdmin') !== env('COOKIE_VALUE')){    
            return redirect()->route('show-login');
        }
        
        $daily  = new DailySummary();
        $result = $daily->getLatestReport(30);
        $colorPalate = ['#BB8FCE','#EC7063','#85C1E9','#F9E79F'];
        $totalIndex = 'Total';
        
        $graphLabel = [];
        $graphData = [$totalIndex =>[] ];
        $graphColor = [$totalIndex => $colorPalate[0]];
        foreach($result as $res){
            $strDate = "\"" . $res->date_of_amount . "\"";
            if(!in_array($strDate, $graphLabel)){
                $graphLabel[] = $strDate;
            }
            
            if(!in_array($res->department->department_name, $graphColor)){
                $graphColor[$res->department->department_name] =  $this->hex2rgba($colorPalate[$res->department_id] ?? $colorPalate[0]);
            }
            
            if (isset($graphData[$totalIndex][$res->date_of_amount])) {
                $graphData[$totalIndex][$res->date_of_amount] += $res->total_amount;
            }else{
                $graphData[$totalIndex][$res->date_of_amount] = $res->total_amount;
            }
            
            $graphData[$res->department->department_name][$res->date_of_amount] = $res->total_amount;
        }

        return view('backoffice-summary-report')->with([
            'graphData' => $graphData,
            'graphLabel' => $graphLabel,
            'graphColor' => $graphColor
        ]);
    }
    
    private function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
    }
}
