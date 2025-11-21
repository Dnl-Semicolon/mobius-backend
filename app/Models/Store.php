<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasUuids;

    protected $fillable = [
        'brand_name','store_name','address_line1','address_line2','city','state',
        'country','postal_code','lat','lng','timezone','status','codex_id'
    ];

    public function placesCodex()
    {
        return $this->belongsTo(PlacesCodex::class, 'codex_id');
    }

    public function bins(): HasMany
    {
        return $this->hasMany(Bin::class);
    }
}
