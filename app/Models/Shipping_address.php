<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_address extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'street',
        'postcode',
        'city',
    ];

}
