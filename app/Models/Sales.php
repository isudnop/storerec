<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'sale_name', 'sale_code',
    ];

    protected $table = 'sales';

    public function getByCode(string $code) : Object
    {
        return $this->where('sale_code', $code)->first();
    }

    public function getByName(string $name) : Object
    {
        return $this->where('sale_name', $name)->first();
    }
}
