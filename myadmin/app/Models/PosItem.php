<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PosItem extends Model
{
    protected $table = 'positems';
    
    protected $fillable = [
        'pos_id',
        'item_name',
        'quantity',
        'price',
        'total'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function pos(): BelongsTo
    {
        return $this->belongsTo(Pos::class);
    }
}
