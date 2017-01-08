<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellRecord extends Model
{
    protected $fillable = [
        'sell_amount', 'sales_id', 'department_id', 'endday_at'
    ];
    
    protected $table = 'sellrecord';
    
    public function getFiveLatestRec()
    {
        return $this->orderBy('created_at', 'desc')->limit(5)->get();
    }
    
    public function getTotalByDate($date)
    {
        return $this
        ->whereDate('endday_at', '=', $date)
        ->sum('sell_amount');
    }
    
    public function getTotalDepartmentByDate($date)
    {
        return $this
        ->selectRaw('department_id, sum(sell_amount) as sum_sell')
        ->whereDate('endday_at', '=', $date)
        ->groupBy('department_id')
        ->get();
    }
    
    public function getTotalSaleByDate($date)
    {
        return $this
        ->selectRaw('sales_id, sum(sell_amount) as sum_sell, count(sell_amount) as count_sell')
        ->whereDate('endday_at', '=', $date)
        ->groupBy('sales_id')
        ->get();
    }
    
    public function getSellDetailOfSaleByDate($sales_id, $date)
    {
        return $this
        ->selectRaw('sales_id, department_id, sum(sell_amount) as sum_sell, count(sell_amount) as count_sell')
        ->whereDate('endday_at', '=', $date)
        ->where('sales_id', '=', $sales_id)
        ->groupBy('sales_id')
        ->groupBy('department_id')
        ->get();
    }
    
    public function sales()
    {
        return $this->belongsTo('\App\Models\Sales');
    }
    
    public function department()
    {
        return $this->belongsTo('\App\Models\Department');
    }
    
    public function endingDay()
    {
        $this->where('endday_at', '=', NULL)->update([
            'endday_at' => date('Y-m-d')
        ]);
    }
}
