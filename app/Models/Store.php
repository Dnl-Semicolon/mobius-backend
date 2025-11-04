<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Store extends Model
{
    use HasUuids;

    protected $fillable = [
        'brand_name','store_name','address_line1','address_line2','city','state',
        'country','postal_code','lat','lng','timezone','status'
    ];
}
