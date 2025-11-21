<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CupEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'bin_session_id',
        'bin_id',
        'brand',
        'material',
        'has_lid',
        'lid_material',
        'has_straw',
        'straw_material',
        'confidence',
        'points_awarded',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function binSession(): BelongsTo
    {
        return $this->belongsTo(BinSession::class);
    }

    public function bin(): BelongsTo
    {
        return $this->belongsTo(Bin::class, 'bin_id', 'hardware_identifier');
    }
}
