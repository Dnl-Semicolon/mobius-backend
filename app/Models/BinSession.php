<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BinSession extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'bin_id',
        'user_id',
        'status',
        'total_points',
        'claim_token',
    ];

    /**
     * Get the user that owns the bin session.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bin(): BelongsTo
    {
        return $this->belongsTo(Bin::class, 'bin_id', 'hardware_identifier');
    }

    /**
     * Get the cup events associated with the bin session.
     */
    public function cupEvents(): HasMany
    {
        return $this->hasMany(CupEvent::class);
    }
}
