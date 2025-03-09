<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    public $fillable = [
        'customer_id',
        'total_amount',
        'status',
        'shipping_address_id'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot(['quantity', 'price']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function shipping_address(): BelongsTo
    {
        return $this->belongsTo(Shipping_address::class);
    }

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn (string | int $value) => $value/100,
            set: fn (string | int $value) => $value*100,
        );
    }
}
