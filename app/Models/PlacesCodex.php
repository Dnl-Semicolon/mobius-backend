<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacesCodex extends Model
{
    protected $table = 'places_codex';

    protected $fillable = [
        'place_id',
        'display_name',
        'address_line1',
        'city',
        'state',
        'country',
        'postal_code',
        'lat',
        'lng',
        'timezone',
        'source',
        'last_verified_at'
    ];

    protected $casts = [
        'last_verified_at' => 'datetime',
        'lat' => 'decimal:6',
        'lng' => 'decimal:6'
    ];

    public function stores()
    {
        return $this->hasMany(Store::class, 'codex_id');
    }
}
