<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellRecord extends Model
{
    protected $fillable = [
        'sell_amount', 'sale_code', 'department'
    ];
    
    protected $table = 'sellrecord';
    
}
