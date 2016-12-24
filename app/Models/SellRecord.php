<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellRecord extends Model
{
    protected $fillable = [
        'sell_amount', 'sales_id', 'department_id'
    ];
    
    protected $table = 'sellrecord';
    
    public function getFiveLatestRec()
    {
        return $this->orderBy('created_at', 'desc')->limit(5)->get();
    }
    
    public function sales()
    {
        return $this->belongsTo('\App\Models\Sales');
    }
    
    public function department()
    {
        return $this->belongsTo('\App\Models\Department' ,'department_id');
    }
}
