<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellRecord extends Model
{
    protected $fillable = [
        'sell_amount', 'sales_id', 'department_id', 'endday_at',
    ];

    protected $table = 'sellrecord';

    /**
     * Get latest five sale rec fro database.
     *
     * @param int $limit
     *
     * @return SellRecord|null
     */
    public function getFiveLatestRec(int $limit = 5) : SellRecord
    {
        return $this->orderBy('created_at', 'desc')->limit($limit)->get() ?? null;
    }

    /**
     * Get total sum of sale amount by specific date.
     *
     * @param string $date
     *
     * @return 
     */
    public function getTotalByDate(string $date)
    {
        return $this
        ->whereDate('endday_at', '=', $date)
        ->sum('sell_amount');
    }

    /**
     * Get total sum of each department store by specific date.
     *
     * @param string $date [description]
     *
     * @return [type] [description]
     */
    public function getTotalDepartmentByDate(string $date)
    {
        return $this
        ->selectRaw('department_id, sum(sell_amount) as sum_sell')
        ->whereDate('endday_at', '=', $date)
        ->groupBy('department_id')
        ->get();
    }

    /**
     * get.
     *
     * @param string $date [description]
     *
     * @return [type] [description]
     */
    public function getTotalSaleByDate(string $date)
    {
        return $this
        ->selectRaw('sales_id, sum(sell_amount) as sum_sell, count(sell_amount) as count_sell')
        ->whereDate('endday_at', '=', $date)
        ->groupBy('sales_id')
        ->get();
    }

    /**
     * get sell rec for each sale by specific date.
     *
     * @param int    $sales_id [description]
     * @param string $date     [description]
     *
     * @return [type] [description]
     */
    public function getSellDetailOfSaleByDate(int $sales_id, string $date)
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
        $this->where('endday_at', '=', null)->update([
            'endday_at' => date('Y-m-d'),
        ]);
    }
}
