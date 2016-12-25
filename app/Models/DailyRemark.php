<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyRemark extends Model
{
    protected $fillable = [
        'date_of_amount', 'total_amount', 'remark'
    ];
    
    protected $table = 'dailyremark';
    
}
