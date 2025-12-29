<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class materiels extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'modele',
        'numero_serie',
        'etat',
        'photo',
        'observation',
        'type_mat_id',
        'region_id',
        'shop_id',
        'user_id'
    ];

    /**
     * Get the user that owns the materiels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Type_materiel(): BelongsTo
    {
        return $this->belongsTo(type_materiels::class, 'type_mat_id');
    }
    /**
     * Get the Regions that owns the materiels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Regions(): BelongsTo
    {
        return $this->belongsTo(regions::class, 'region_id');
    }

    /**
     * Get the Shops that owns the materiels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Shops(): BelongsTo
    {
        return $this->belongsTo(shops::class, 'shop_id', 'id');
    }

    /**
     * Get the user that owns the materiels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The Etat_Mate that belong to the materiels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Etat_Mate(): BelongsTo
    {
        return $this->belongsTo(etat_mate::class, 'etat', 'id');
    }
}
