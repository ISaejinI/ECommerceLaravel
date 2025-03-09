<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipping_address extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'street',
        'postcode',
        'city',
    ];

    public function Order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
