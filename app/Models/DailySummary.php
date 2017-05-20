<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailySummary extends Model
{
    protected $fillable = [
        'date_of_amount', 'department_id', 'total_amount', 'remark',
    ];

    protected $table = 'dailysummary';

    public function getLatestReport(int $limit = 30)
    {
        return $this->orderBy('date_of_amount', 'desc')->limit($limit)->get();
    }

    public function department()
    {
        return $this->belongsTo('\App\Models\Department');
    }
}
