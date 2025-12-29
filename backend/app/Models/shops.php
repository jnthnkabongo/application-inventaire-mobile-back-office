<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class shops extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id'
    ];

    /**
     * Get the user that owns the shops
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Regions(): BelongsTo
    {
        return $this->belongsTo(regions::class, 'region_id', 'id');
    }
}
