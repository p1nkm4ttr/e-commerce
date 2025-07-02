<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'original_id',
        'customer_name',
        'customer_email',
        'status',
        'total_amount',
        'created_at',
        'items',
        'address',
        'phone',
        'picker_id',
        'packer_id',
        'rider_id'  
    ];

    protected $casts = [
        'items' => 'array',
        'address' => 'array',
        'total_amount' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $appends = ['items_count'];

    public function getItemsCountAttribute()
    {
        return count($this->items ?? []);
    }

    public function getProductDetails($productId)
    {
        return ImageForm::find($productId);
    }

    public function getItemsWithDetailsAttribute()
    {
        if (!$this->items) return [];
        
        return collect($this->items)->map(function($item) {
            $product = $this->getProductDetails($item['product_id']);
            return array_merge($item, [
                'name' => $product ? $product->name : 'Product #' . $item['product_id'],
                'image' => $product ? '/images/products/' . $product->image : null,
                'barcode' => $product ? $product->barcode : null // Add this line
            ]);
        })->toArray();
    }

    public function picker()
    {
        return $this->belongsTo(AdminUser::class, 'picker_id');
    }

    public function packer()
    {
        return $this->belongsTo(AdminUser::class, 'packer_id');
    }

    public function rider()
    {
        return $this->belongsTo(AdminUser::class, 'rider_id');
    }
}