<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bin extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'store_id',
        'name',
        'hardware_identifier',
        'location_name',
        'lat',
        'lng',
        'status',
        'last_seen_at',
        'notes',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'last_seen_at' => 'datetime',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function binSessions(): HasMany
    {
        return $this->hasMany(BinSession::class, 'bin_id', 'hardware_identifier');
    }

    public function cupEvents(): HasMany
    {
        return $this->hasMany(CupEvent::class, 'bin_id', 'hardware_identifier');
    }
}
