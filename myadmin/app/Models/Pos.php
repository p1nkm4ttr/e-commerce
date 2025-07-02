<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pos extends Model
{
    protected $table = 'pos';
    
    protected $fillable = [
        'payment_id',
        'total_amount',
        'tax_amount',
        'discount',
        'payment_status'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount' => 'decimal:2',
    ];
    public static function createPayment($total, $tax)
    {
        $lastPaymentId = self::max('payment_id') ?? 999;
        
        return self::create([
            'payment_id' => $lastPaymentId + 1,
            'total_amount' => $total,
            'tax_amount' => $tax,
            'discount' => 0,
            'payment_status' => 'completed'
        ]);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PosItem::class);
    }
}
